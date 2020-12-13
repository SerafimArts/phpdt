<?php

/**
 * This file is part of Parser package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace DataTypes\Parser\Ast\Stmt;

use DataTypes\Parser\Ast\Expr\Expression;
use DataTypes\Parser\Ast\Identifier;
use JetBrains\PhpStorm\Immutable;
use JetBrains\PhpStorm\Pure;

class TypeStatement extends Statement
{
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
     * @var Expression
     */
    #[Immutable]
    public Expression $type;

    /**
     * @param Identifier $name
     * @param iterable<GenericParameter> $parameters
     * @param Expression $type
     */
    public function __construct(Identifier $name, iterable $parameters, Expression $type)
    {
        $this->name = $name;
        $this->parameters = [...$parameters];
        $this->type = $type;
    }

    /**
     * {@inheritDoc}
     */
    #[Pure]
    public function getIterator(): \Traversable
    {
        yield 'name' => $this->name;
        yield 'parameters' => $this->parameters;
        yield 'type' => $this->type;
    }
}
