<?php declare(strict_types=1);

/**
 * This file is part of pmg/support
 *
 * Copyright (c) PMG <https://www.pmg.com>.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PMG\Support\Fixtures;

use PMG\Support\HasId;
use PMG\Support\Id;
use PMG\Support\ImplementsHasId;

class TestHasId implements HasId
{
    use ImplementsHasId;

    public function __construct(?Id $id)
    {
        $this->setIdentifier($id);
    }
}
