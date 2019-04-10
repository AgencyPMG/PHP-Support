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

final class Uuid implements Id
{
    const PATTERN = '/^[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}$/';

    private $uuid;

    public function __construct(string $uuid)
    {
        $v = strtolower($uuid);
        if (!preg_match(self::PATTERN, $v)) {
            throw new InvalidId(sprintf(
                '%s is not a valid UUID',
                $uuid
            ));
        }
        $this->uuid = $v;
    }

    /**
     * {@inheritdoc}
     */
    public function __toString() : string
    {
        return $this->uuid;
    }
}
