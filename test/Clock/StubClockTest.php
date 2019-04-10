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
use PMG\Support\TestCase;

class StubClockTest extends TestCase
{
    private $date, $clock;

    public function testNowReturnsTheSameDateGiven()
    {
        $this->assertEquals($this->date, $this->clock->now());
    }

    public function testFromReturnsTheSameDateGiven()
    {
        $this->assertEquals($this->date, $this->clock->from('ignored'));
    }

    public function testEnsureReturnsTheSameDateGiven()
    {
        $this->assertEquals($this->date, $this->clock->ensure('ignored'));
    }

    protected function setUp() : void
    {
        $this->date = new DateTimeImmutable('2017-07-13 00:00:00');
        $this->clock = new StubClock($this->date);
    }
}
