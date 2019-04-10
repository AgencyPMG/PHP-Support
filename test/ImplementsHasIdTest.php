<?php declare(strict_types=1);

/**
 * This file is part of pmg/support
 *
 * Copyright (c) PMG <https://www.pmg.com>.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PMG\Support;

use PMG\Support\Ids\Uuid;
use PMG\Support\Fixtures\TestHasId;

class ImplementsHasIdTest extends TestCase
{
    public function testNullIdentiferGeneratesANewUuid()
    {
        $obj = new TestHasId(null);

        $this->assertInstanceOf(Uuid::class, $obj->getIdentifier());
    }

    public function testGetIdentiferReturnsTheValueThatWasPassedToTheConstructor()
    {
        $id = Ids::stub(__CLASS__);
        $obj = new TestHasId($id);

        $this->assertSame($id, $obj->getIdentifier());
    }
}
