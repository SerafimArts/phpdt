<?php

/**
 * This file is part of Parser package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace DataTypes\Parser\Ast;

use JetBrains\PhpStorm\Immutable;

class Identifier extends Node implements \Stringable
{
    /**
     * @var string
     */
    #[Immutable]
    public string $name;

    /**
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * Get lowercased identifier as string.
     *
     * @return string Lowercased identifier as string
     */
    public function toLowerString(): string
    {
        return \mb_strtolower($this->name);
    }

    /**
     * Get identifier as string.
     *
     * @return string Identifier as string.
     */
    public function __toString(): string
    {
        return $this->name;
    }
}
