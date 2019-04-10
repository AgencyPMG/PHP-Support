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

use function get_class;
use function gettype;
use function is_object;
use function is_array;
use function strtolower;

final class Types
{
    public static function of($value) : string
    {
        return is_object($value) ? get_class($value) : self::gettype($value);
    }

    public static function repr($value) : string
    {
        if (is_object($value)) {
            return sprintf('object(%s)', get_class($value));
        }

        if (is_array($value)) {
            return sprintf('array(%s)', json_encode($value));
        }

        return sprintf('%s(%s)', self::gettype($value), (string) $value);
    }

    private static function gettype($value) : string
    {
        return strtolower(gettype($value));
    }
}
