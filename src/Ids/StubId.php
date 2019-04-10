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

final class StubId implements Id
{
    private $id;

    public function __construct(string $id)
    {
        $this->id = $id;
    }

    /**
     * {@inheritdoc}
     */
    public function __toString() : string
    {
        return $this->id;
    }
}
