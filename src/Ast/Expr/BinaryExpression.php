<?php

/**
 * This file is part of Parser package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace DataTypes\Parser\Ast\Expr;

use JetBrains\PhpStorm\Immutable;

abstract class BinaryExpression extends Expression
{
    /**
     * @var Expression
     */
    #[Immutable]
    public Expression $a;

    /**
     * @var Expression
     */
    #[Immutable]
    public Expression $b;

    /**
     * @param Expression $a
     * @param Expression $b
     */
    public function __construct(Expression $a, Expression $b)
    {
        $this->a = $a;
        $this->b = $b;
    }

    /**
     * {@inheritDoc}
     */
    public function getIterator(): \Traversable
    {
        yield 'a' => $this->a;
        yield 'b' => $this->b;
    }
}
