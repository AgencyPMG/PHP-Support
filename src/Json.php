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

use function json_decode;
use function json_encode;
use function json_last_error;
use PMG\Support\Json\JsonDecodeError;
use PMG\Support\Json\JsonEncodeError;

final class Json
{
    public static function decode(string $in) : array
    {
        $out = json_decode($in, true);
        if (null === $out && self::hasJsonError()) {
            throw JsonDecodeError::fromLastError();
        }

        return $out;
    }

    public static function encode($in, int $options=0) : string
    {
        $out = json_encode($in, $options);
        if (false === $out) {
            throw JsonEncodeError::fromLastError(sprintf(
                'Could not encode %s - ',
                Types::of($in)
            ));
        }

        return $out;
    }

    private static function hasJsonError()
    {
        return json_last_error() !== JSON_ERROR_NONE;
    }
}
