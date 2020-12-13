<?php

/**
 * This file is part of Parser package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace DataTypes\Parser\Tests\Ast;

use DataTypes\Parser\Tests\TestCase;

abstract class AstTestCase extends TestCase
{
    protected function assertAstInstanceOf(string $class, string $source, string $message = ''): void
    {
        $this->assertInstanceOf($class, $this->parse($source), $message);
    }

    protected function assertAstStructureEquals(array $expected, string $source, string $message = ''): void
    {
        dd($this->parse());
    }
}
