<?php declare(strict_types=1);

/*
 * This file is part of pmg/core-bundle
 *
 * Copyright (c) PMG <https://www.pmg.com>.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PMG\Support;

/**
 * Marks an object has having an identifier.
 *
 * @since 1.0
 */
interface HasId
{
    public function getIdentifier() : Id;
}
