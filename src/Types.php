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

final class Types
{
    public static function of($value) : string
    {
        return is_object($value) ? get_class($value) : strtolower(gettype($value));
    }

    public static function repr($value) : string
    {
        if (is_object($value)) {
            return get_class($value);
        }

        if (is_array($value)) {
            return json_encode($value);
        }

        return (string) $value;
    }
}
