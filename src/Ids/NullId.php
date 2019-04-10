<?php declare(strict_types=1);

/**
 * This file is part of pmg/support
 *
 * Copyright (c) PMG <https://www.pmg.com>.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PMG\Support\Ids;

use PMG\Support\Id;

/**
 * A "null" id object. Use this instead of having a literal `null` for ids.
 *
 * @since 1.0
 */
final class NullId implements Id
{
    /**
     * {@inheritdoc}
     */
    public function __toString() : string
    {
        return '___NULLID___';
    }
}
