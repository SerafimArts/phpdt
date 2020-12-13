<?php

/**
 * This file is part of Parser package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace DataTypes\Parser\Tests;

use DataTypes\Parser\Ast\Node;
use DataTypes\Parser\Parser;
use Phplrt\Contracts\Ast\NodeInterface;
use Phplrt\Contracts\Exception\RuntimeExceptionInterface;
use PHPUnit\Framework\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    /**
     * @param string $source
     * @return array<NodeInterface>
     * @throws RuntimeExceptionInterface
     * @throws \Throwable
     */
    protected function parseAll(string $source): array
    {
        return [...(new Parser())->parse($source)];
    }

    /**
     * @param string $source
     * @return Node
     * @throws RuntimeExceptionInterface
     * @throws \Throwable
     */
    protected function parse(string $source): Node
    {
        $result = $this->parseAll($source);

        return reset($result);
    }
}
