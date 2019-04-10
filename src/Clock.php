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

use DateTimeImmutable;

/**
 * A system clock implementation. This is a way to centralize `DateTime` creation.
 *
 * @since 1.0
 */
abstract class Clock
{
    private static $default = null;

    /**
     * Get the current time.
     */
    abstract public function now() : DateTimeImmutable;

    /**
     * Create a date time object from a string.
     *
     * @param $datestr The date string to convert.
     */
    abstract public function from(string $datestr) : DateTimeImmutable;

    /**
     * Given a date time object or a string ensure that it gets turned into
     * a `DateTimeImmutable` that's processed according to the the clocks
     * rules.
     *
     * @param \DateTime|\DateTimeImmutable|string $in The value to ensure is a date
     * @throws InvalidArgumentException if something is wrong with the input
     */
    abstract public function ensure($in) : DateTimeImmutable;

    public static function get() : self
    {
        if (!self::$default) {
            self::$default = Clock\TzAwareClock::utc();
        }

        return self::$default;
    }

    public static function defaultNow() : DateTimeImmutable
    {
        return self::get()->now();
    }

    public static function defaultFrom(string $datestr) : DateTimeImmutable
    {
        return self::get()->from($datestr);
    }

    public static function defaultEnsure($in) : DateTimeImmutable
    {
        return self::get()->ensure($in);
    }
}
