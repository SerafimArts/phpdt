<?php

/**
 * This file is part of Parser package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);


/**
 * This file is part of Flux package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Phplrt\Compiler\Compiler;
use Phplrt\Source\File;

require __DIR__ . '/../vendor/autoload.php';

$input = __DIR__ . '/../resources/grammar.pp2';
$output = __DIR__ . '/../src/grammar.php';

// Execute

$result = (new Compiler())
    ->load(File::fromPathname($input))
    ->build()
;

$result->withClassUsage('DataTypes\\Parser\\Ast');

\file_put_contents($output, $result->generate());
