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

class TypesTest extends TestCase
{
    public static function ofProvider()
    {
        return [
            [new \stdClass(), 'stdClass'],
            [null, 'null'],
            ['a string', 'string'],
        ];
    }

    /**
     * @dataProvider ofProvider
     */
    public function testOfReturnsTheExpectedTypeName($value, $expected)
    {
        $this->assertSame($expected, Types::of($value));
    }

    public static function reprProvider()
    {
        return [
            [new \stdClass(), 'stdClass'],
            [['array'], '["array"]'],
            ['a string', 'a string'],
        ];
    }

    /**
     * @dataProvider reprProvider
     */
    public function testReprReturnsStringRepresentationOfValue($value, $expected)
    {
        $this->assertSame($expected, Types::repr($value));
    }
}
