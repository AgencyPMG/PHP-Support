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
 * Provides and object with methods relating to identifiers.
 *
 * @since   1.0
 */
trait ImplementsHasId
{
    /**
     * The objects identifier. Identifiers cannot be changed after
     * object creation (since changing the identifier would be chaning
     * the object itself).
     *
     * @var string
     */
    private $ident;

    /**
     * Get the identifier of the object.
     *
     * @return Id
     */
    public function getIdentifier() : Id
    {
        return $this->ident;
    }

    /**
     * Use internally to set the identifier on the object.
     *
     * @param   string|null $ident The identifer to set. If this is null a new
     *          identifier will be created.
     * @return  void
     */
    protected function setIdentifier(?Id $ident) : void
    {
        $this->ident = null === $ident ? Ids::generate() : $ident;
    }
}
