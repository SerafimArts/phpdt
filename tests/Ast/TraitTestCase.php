<?php

/**
 * This file is part of Parser package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace DataTypes\Parser\Tests\Ast;

use DataTypes\Parser\Ast\Stmt\TraitStatement;

class TraitTestCase extends ClassLikeTestCase
{
    public function testInstanceOf(): void
    {
        $this->assertAstInstanceOf(TraitStatement::class, 'trait Test;');
    }
}
