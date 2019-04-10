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

use DateTime;
use DateTimeImmutable;
use DateTimeZone;
use PMG\Support\Clock;
use PMG\Support\Types;
use PMG\Support\Exception\InvalidArgumentException;

/**
 * A clock that's aware of a timezone and uses it to create dates.
 *
 * @since 2017-07-13
 */
final class TzAwareClock extends Clock
{
    private $tz;

    public function __construct(DateTimeZone $tz)
    {
        $this->tz = $tz;
    }

    public static function utc() : self
    {
        return new self(new DateTimeZone('UTC'));
    }

    /**
     * {@inheritdoc}
     */
    public function now() : DateTimeImmutable
    {
        return DateTimeImmutable::createFromFormat('U', (string) time(), $this->tz);
    }

    /**
     * {@inheritdoc}
     */
    public function from(string $datestr) : DateTimeImmutable
    {
        return $this->applyTz(new DateTimeImmutable($datestr));
    }

    /**
     * {@inheritdoc}
     */
    public function ensure($in) : DateTimeImmutable
    {
        if ($in instanceof DateTime) {
            return $this->applyTz(DateTimeImmutable::createFromMutable($in));
        }

        if ($in instanceof DateTimeImmutable) {
            return $this->applyTz($in);
        }

        if (is_string($in)) {
            return $this->from($in);
        }

        throw new InvalidArgumentException(sprintf(
            '%s expects a DateTime, DateTimeImmutable or string, got "%s"',
            __METHOD__,
            Types::of($in)
        ));
    }

    private function applyTz(DateTimeImmutable $in) : DateTimeImmutable
    {
        return $in->setTimezone($this->tz);
    }
}
