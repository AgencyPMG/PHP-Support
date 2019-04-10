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
use PMG\Support\Clock;

/**
 * A `Clock` implementation that alwasy returns the same date.
 *
 * @since 2017-07-13
 */
final class StubClock extends Clock
{
    private $date;

    public function __construct(DateTimeImmutable $date)
    {
        $this->date = $date;
    }

    /**
     * {@inheritdoc}
     */
    public function now() : DateTimeImmutable
    {
        return clone $this->date;
    }

    /**
     * {@inheritdoc}
     */
    public function from(string $datestr) : DateTimeImmutable
    {
        return clone $this->date;
    }

    /**
     * {@inheritdoc}
     */
    public function ensure($in) : DateTimeImmutable
    {
        return clone $this->date;
    }
}
