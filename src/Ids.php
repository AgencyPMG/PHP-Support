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

use Ramsey\Uuid\Uuid as RamseyUuid;
use PMG\Support\Ids\InvalidId;
use PMG\Support\Ids\NullId;
use PMG\Support\Ids\StubId;
use PMG\Support\Ids\Uuid;

/**
 * Creates identifiers for objects.
 *
 * @since   2015-07-25
 */
final class Ids
{
    /**
     * Generate a new unique identifier (a UUID).
     */
    public static function generate() : Id
    {
        return new Uuid((string) RamseyUuid::uuid4());
    }

    public static function from(string $id) : Id
    {
        return new Uuid($id);
    }

    public static function ensure($in) : Id
    {
        if ($in instanceof Id) {
            return $in;
        }

        if (is_string($in)) {
            return self::from($in);
        }

        throw new InvalidId(sprintf(
            'Cannot convert a `%s` to an `%s`',
            Types::of($in),
            Id::class
        ));
    }

    public static function stub(string $value) : StubId
    {
        return new StubId($value);
    }

    public static function none() : NullId
    {
        return new NullId();
    }
}
