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

/**
 * An identifier.
 *
 * @since 2017-07-14
 */
interface Id
{
    public function __toString() : string;
}
