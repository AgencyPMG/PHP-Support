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

use PMG\Support\Ids\InvalidId;

class IdsTest extends TestCase
{
    const UUID = 'c7af1717-b4b5-46d9-bc96-89c8acccfdea';

    public function testGenerateReturnsAnIdInstance()
    {
        $this->assertInstanceOf(Id::class, Ids::generate());
    }

    public function testFromReturnsAnIdFromTheGivenString()
    {
        $id = Ids::from(self::UUID);

        $this->assertEquals(self::UUID, (string) $id);
    }

    public function testFromErrorsWhenGivenAnInvalidInput()
    {
        $this->expectException(InvalidId::class);
        Ids::from('noNope');
    }

    public static function ensureValid()
    {
        return [
            [Ids::from(self::UUID)],
            [self::UUID],
        ];
    }

    /**
     * @dataProvider ensureValid
     */
    public function testEnsureWithValidInputReturnsExpectedId($in)
    {
        $id = Ids::ensure(self::UUID);

        $this->assertEquals(self::UUID, (string) $id);
    }

    public static function ensureInvalid()
    {
        return [
            [123],
            [12.3],
            [new \stdClass()],
            [null],
        ];
    }

    /**
     * @dataProvider ensureInvalid
     */
    public function testEnsureErrorsWhenGivenAnInvalidInput($in)
    {
        $this->expectException(InvalidId::class);
        Ids::ensure($in);
    }

    public function testStubReturnsAStubIdWithTheGivenValue()
    {
        $id = Ids::stub('nope');

        $this->assertSame('nope', (string) $id);
    }
}
