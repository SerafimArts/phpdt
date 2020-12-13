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
use DataTypes\Parser\Ast\Name;

/**
 * @psalm-type VarianceType = GenericParameter::VARIANCE_*
 */
class GenericParameter extends Statement
{
    /**
     * @var int
     */
    public const VARIANCE_ANY = 0x00;

    /**
     * @var int
     */
    public const VARIANCE_IN = 0x01;

    /**
     * @var int
     */
    public const VARIANCE_OUT = 0x02;

    /**
     * @var Identifier
     */
    public Identifier $name;

    /**
     * @var VarianceType
     */
    public int $variance = self::VARIANCE_ANY;

    /**
     * @var Expression|null
     */
    public ?Expression $of;

    /**
     * @param Identifier $name
     * @param VarianceType $variance
     * @param Expression|null $of
     */
    public function __construct(
        Identifier $name,
        int $variance = self::VARIANCE_ANY,
        Expression $of = null
    ) {
        $this->name = $name;
        $this->variance = $variance;
        $this->of = $of;
    }

    /**
     * {@inheritDoc}
     */
    public function getIterator(): \Traversable
    {
        yield 'name' => $this->name;

        if ($this->of) {
            yield 'of' => $this->of;
        }
    }
}
