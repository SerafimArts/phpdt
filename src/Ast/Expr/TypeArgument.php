<?php

/**
 * This file is part of Parser package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace DataTypes\Parser\Ast\Expr;

use DataTypes\Parser\Ast\Name;
use JetBrains\PhpStorm\Immutable;

class TypeArgument extends Argument
{
    /**
     * @var Name
     */
    #[Immutable]
    public Name $name;

    /**
     * @var array<Argument>
     */
    #[Immutable]
    public array $arguments = [];

    /**
     * @param Name $name
     * @param array<Argument> $arguments
     */
    public function __construct(Name $name, array $arguments = [])
    {
        $this->name = $name;
        $this->arguments = $arguments;
    }

    /**
     * {@inheritDoc}
     */
    public function getIterator(): \Traversable
    {
        yield 'name' => $this->name;
        yield 'arguments' => $this->arguments;
    }
}
