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
use JetBrains\PhpStorm\Pure;
use Phplrt\Contracts\Ast\NodeInterface;
use Phplrt\Contracts\Source\ReadableInterface;

abstract class Node implements NodeInterface
{
    /**
     * @var positive-int
     */
    #[Immutable]
    public int $offset = 0;

    /**
     * @var ReadableInterface|null
     */
    #[Immutable]
    public ?ReadableInterface $source = null;

    /**
     * @return \Traversable<NodeInterface>
     */
    #[Pure]
    public function getIterator(): \Traversable
    {
        return new \EmptyIterator();
    }
}
