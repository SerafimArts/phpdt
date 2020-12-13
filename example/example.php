<?php

declare(strict_types=1);

use DataTypes\Parser\Parser;

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../bin/compile.php';

$parser = new Parser();

$ast = $parser->parse(new \SplFileInfo(__DIR__ . '/complex.d.php'));

dump($ast);



