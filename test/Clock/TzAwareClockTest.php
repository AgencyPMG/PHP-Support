<?php declare(strict_types=1);

/**
 * This file is part of pmg/support
 *
 * Copyright (c) PMG <https://www.pmg.com>.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PMG\Support\Clock;

use DateTimeImmutable;
use DateTimeZone;
use PMG\Support\TestCase;
use PMG\Support\Exception\InvalidArgumentException;

class TzAwareClockTest extends TestCase
{
    const TS = '2017-07-13 00:00:00';

    private $tz, $expected, $clock;

    public function testNowReturnsTheCurrentTime()
    {
        $now = $this->clock->now();

        $this->assertEquals($this->tz, $now->getTimeZone());
    }

    public function testFromReturnsTheValueInStringAsDateTime()
    {
        $time = $this->clock->from(self::TS);

        $this->assertEquals($this->expected, $time);
    }

    public static function ensureValid()
    {
        return [
            [new \DateTime(self::TS, new \DateTimeZone('+00:00'))],
            [new \DateTimeImmutable(self::TS, new \DateTimeZone('+00:00'))],
            [self::TS],
        ];
    }

    /**
     * @dataProvider ensureValid
     */
    public function testEnsureReturnsTheExpectedValueWithValidInput($in)
    {
        $time = $this->clock->ensure($in);

        $this->assertEquals($this->expected, $time);
    }

    public static function ensureInvalid()
    {
        return [
            [123],
            [12.3],
            [new \stdClass()],
        ];
    }

    /**
     * @dataProvider ensureInvalid
     */
    public function testEnsureErrorsWhenGivenAnInvalidInput($in)
    {
        $this->expectException(InvalidArgumentException::class);
        $this->clock->ensure($in);
    }

    protected function setUp() : void
    {
        $this->tz = new DateTimeZone('+00:00');
        $this->expected = new DateTimeImmutable(self::TS, $this->tz);
        $this->clock = new TzAwareClock($this->tz);
    }
}
