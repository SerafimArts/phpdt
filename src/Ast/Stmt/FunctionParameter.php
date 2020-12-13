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

class FunctionParameter extends Statement
{
    /**
     * @var Identifier
     */
    #[Immutable]
    public Identifier $name;

    /**
     * @var Expression
     */
    #[Immutable]
    public Expression $type;

    /**
     * @param Identifier $name
     * @param Expression $type
     */
    public function __construct(Identifier $name, Expression $type)
    {
        $this->name = $name;
        $this->type = $type;
    }

    /**
     * {@inheritDoc}
     */
    public function getIterator(): \Traversable
    {
        yield 'name' => $this->name;
        yield 'type' => $this->type;
    }
}
