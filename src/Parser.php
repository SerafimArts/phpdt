<?php

/**
 * This file is part of Parser package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace DataTypes\Parser;

use DataTypes\Parser\Ast\Node;
use Phplrt\Contracts\Exception\RuntimeExceptionInterface;
use Phplrt\Contracts\Lexer\LexerInterface;
use Phplrt\Contracts\Parser\ParserInterface;
use Phplrt\Contracts\Source\ReadableInterface;
use Phplrt\Lexer\Lexer;
use Phplrt\Parser\BuilderInterface;
use Phplrt\Parser\ContextInterface;
use Phplrt\Parser\Parser as Combinator;

final class Parser implements
    ParserInterface,
    BuilderInterface,
    LexerInterface
{
    /**
     * @var string
     */
    public const GRAMMAR_FILE = __DIR__ . '/../resources/grammar.php';

    /**
     * @var ParserInterface
     */
    private ParserInterface $parser;

    /**
     * @var LexerInterface
     */
    private LexerInterface $lexer;

    /**
     * @var array<\Closure>
     */
    private array $reducers;

    /**
     * Parser constructor.
     */
    public function __construct()
    {
        $grammar = $this->grammar();

        $this->reducers = $grammar['reducers'];
        $this->lexer = new Lexer($grammar['tokens']['default'], $grammar['skip']);
        $this->parser = new Combinator($this, $grammar['grammar'], [
            Combinator::CONFIG_AST_BUILDER  => $this,
            Combinator::CONFIG_INITIAL_RULE => $grammar['initial'],
        ]);
    }

    /**
     * @return array {
     *      initial: string,
     *      tokens: array { default: array<string, string> },
     *      skip: array<int, string>,
     *      grammar: array<string, RuleInterface>,
     *      reducers: array<\Closure>
     * }
     */
    private function grammar(): array
    {
        return require __DIR__ . '/grammar.php';
    }

    /**
     * {@inheritDoc}
     */
    public function lex($source, int $offset = 0): iterable
    {
        return $this->lexer->lex($source, $offset);
    }

    /**
     * {@inheritDoc}
     *
     * @noinspection PhpImmutablePropertyIsWrittenInspection
     */
    public function build(ContextInterface $context, $result)
    {
        $id = $context->getState();


        if (isset($this->reducers[$id])) {
            $result = $this->reducers[$id]($context, $result);

            if ($result instanceof Node) {
                $result->source = $context->getSource();
                $result->offset = $context->getToken()->getOffset();
            }

            return $result;
        }

        return null;
    }

    /**
     * @param ReadableInterface|resource|string $source
     * @param array $options
     * @return iterable
     * @throws RuntimeExceptionInterface
     * @throws \Throwable
     */
    public function parse($source, array $options = []): iterable
    {
        return $this->parser->parse($source, $options);
    }
}
