<?php

/**
 * This file is part of Parser package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace DataTypes\Parser\Ast\Stmt;

use JetBrains\PhpStorm\Pure;

class MethodStatement extends FunctionLikeStatement
{
    public const IS_PUBLIC      = 1 << 3;
    public const IS_PRIVATE     = 1 << 4;
    public const IS_PROTECTED   = 1 << 5;
    public const IS_STATIC      = 1 << 6;
    public const IS_OPT_STATIC  = 1 << 7;

    /**
     * @var int
     */
    public int $modifiers = 0;

    /**
     * @param FunctionLikeStatement $fn
     * @param int $modifiers
     */
    #[Pure]
    public function __construct(FunctionLikeStatement $fn, int $modifiers = 0)
    {
        $this->modifiers = $modifiers;

        parent::__construct($fn->name, $fn->type, $fn->parameters, $fn->arguments);
    }
}
