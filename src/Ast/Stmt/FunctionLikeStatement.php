<?php

/**
 * This file is part of Parser package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace DataTypes\Parser\Ast\Stmt;

use DataTypes\Parser\Ast\Expr\Argument;
use DataTypes\Parser\Ast\Expr\Expression;
use DataTypes\Parser\Ast\Identifier;
use JetBrains\PhpStorm\Immutable;
use JetBrains\PhpStorm\Pure;

abstract class FunctionLikeStatement extends Statement
{
    /**
     * @var int
     */
    public const IS_INTERNAL = 1 << 1;

    /**
     * @var int
     */
    public const IS_VIRTUAL = 1 << 1;

    /**
     * @var int
     */
    public int $modifiers = 0;

    /**
     * @var Identifier
     */
    #[Immutable]
    public Identifier $name;

    /**
     * @var array<GenericParameter>
     */
    #[Immutable]
    public array $parameters = [];

    /**
     * @var array<Argument>
     */
    public array $arguments = [];

    /**
     * @var Expression
     */
    #[Immutable]
    public Expression $type;

    /**
     * @var bool
     */
    #[Immutable]
    public bool $pure = false;

    /**
     * @param Identifier $name
     * @param Expression $type
     * @param iterable $parameters
     * @param iterable $arguments
     */
    #[Pure]
    public function __construct(
        Identifier $name,
        Expression $type,
        iterable $parameters = [],
        iterable $arguments = []
    ) {
        $this->name = $name;
        $this->type = $type;
        $this->parameters = [...$parameters];
        $this->arguments = [...$arguments];
    }

    /**
     * {@inheritDoc}
     */
    #[Pure]
    public function getIterator(): \Traversable
    {
        yield 'name' => $this->name;
        yield 'parameters' => $this->parameters;
        yield 'arguments' => $this->arguments;
        yield 'type' => $this->type;
    }
}
