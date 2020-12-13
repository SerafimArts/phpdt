<?php

/**
 * This file is part of Parser package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace DataTypes\Parser\Ast\Stmt;

use DataTypes\Parser\Ast\Identifier;
use JetBrains\PhpStorm\Immutable;
use JetBrains\PhpStorm\Pure;

abstract class ClassLikeStatement extends Statement
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
     * @var array<PropertyStatement>
     */
    #[Immutable]
    public array $properties = [];

    /**
     * @var array<MethodStatement>
     */
    #[Immutable]
    public array $methods = [];

    /**
     * @param Identifier $name
     * @param iterable<GenericParameter> $parameters
     */
    public function __construct(Identifier $name, iterable $parameters = [])
    {
        $this->name = $name;
        $this->parameters = [...$parameters];
    }

    /**
     * @return bool
     */
    #[Pure]
    public function isGeneric(): bool
    {
        return \count($this->parameters) > 0;
    }

    /**
     * {@inheritDoc}
     */
    #[Pure]
    public function getIterator(): \Traversable
    {
        yield 'name' => $this->name;
        yield 'parameters' => $this->parameters;
        yield 'properties' => $this->properties;
        yield 'methods' => $this->methods;
    }
}
