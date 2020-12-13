<?php

/**
 * This file is part of Parser package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace DataTypes\Parser\Ast\Stmt;

use DataTypes\Parser\Ast\Expr\TypeArgument;
use DataTypes\Parser\Ast\Identifier;
use JetBrains\PhpStorm\Immutable;
use JetBrains\PhpStorm\Pure;

class ClassStatement extends ClassLikeStatement
{
    /**
     * @var array<TypeArgument>
     */
    #[Immutable]
    public array $parent = [];

    /**
     * @param Identifier $name
     * @param iterable|array $parameters
     * @param iterable|array $parent
     */
    public function __construct(Identifier $name, iterable $parameters = [], iterable $parent = [])
    {
        parent::__construct($name, $parameters);

        $this->parent = [...$parent];
    }

    /**
     * @return bool
     */
    #[Pure]
    public function isStructure(): bool
    {
        return \count($this->methods) === 0;
    }
}
