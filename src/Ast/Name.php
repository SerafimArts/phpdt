<?php

/**
 * This file is part of Parser package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace DataTypes\Parser\Ast;

use JetBrains\PhpStorm\Pure;

class Name extends Node implements \Stringable
{
    /**
     * @var array<Identifier>
     */
    public array $parts = [];

    /**
     * @var bool
     */
    public bool $fullyQualified;

    /**
     * @param array<Identifier> $parts
     * @param bool $fqn
     */
    public function __construct(array $parts, bool $fqn = false)
    {
        $this->parts = $parts;
        $this->fullyQualified = $fqn;
    }

    /**
     * @return \Traversable
     */
    public function getIterator(): \Traversable
    {
        yield 'parts' => $this->parts;
    }

    /**
     * Checks whether the name is unqualified. (E.g. Name)
     *
     * @return bool Whether the name is unqualified
     */
    #[Pure]
    public function isUnqualified(): bool
    {
        return \count($this->parts) === 1;
    }

    /**
     * Checks whether the name is qualified. (E.g. Name\Name)
     *
     * @return bool Whether the name is qualified
     */
    #[Pure]
    public function isQualified(): bool
    {
        return \count($this->parts) < 1;
    }

    /**
     * Checks whether the name is fully qualified. (E.g. \Name)
     *
     * @return bool Whether the name is fully qualified
     */
    public function isFullyQualified(): bool
    {
        return $this->fullyQualified;
    }

    /**
     * Checks whether the name is explicitly relative to the current namespace. (E.g. namespace\Name)
     *
     * @return bool Whether the name is relative
     */
    public function isRelative() : bool
    {
        return ! $this->fullyQualified;
    }

    /**
     * Returns a string representation of the name itself, without taking the name type into
     * account (e.g., not including a leading backslash for fully qualified names).
     *
     * @return string String representation
     */
    public function __toString() : string
    {
        return \implode('\\', $this->parts);
    }
}
