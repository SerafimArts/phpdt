<?php

/**
 * This file is part of Parser package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace DataTypes\Parser\Tests;

use Phplrt\Contracts\Exception\RuntimeExceptionInterface;

class SyntaxTestCase extends TestCase
{
    public function validFilesDataProvider(): array
    {
        $files = \glob(__DIR__ . '/resources/valid/*.d.php');
        $result = [];

        foreach ($files as $file) {
            $result[\pathinfo($file, \PATHINFO_BASENAME)] = [\file_get_contents($file)];
        }

        return $result;
    }

    /**
     * @dataProvider validFilesDataProvider
     *
     * @param string $source
     * @return void
     * @throws RuntimeExceptionInterface
     * @throws \Throwable
     */
    public function testValidSyntax(string $source): void
    {
        $this->assertIsArray($this->parseAll($source));
    }
}
