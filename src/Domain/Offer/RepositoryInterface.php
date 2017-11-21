<?php

namespace Webbala\Domain\Offer;

use Webbala\Domain\Models\Offer;

interface RepositoryInterface
{
    /**
     * @return Offer[]
     */
    public function getAll();

    /**
     * @param Offer $offer
     *
     * @return bool
     */
    public function save(Offer $offer);

    /**
     * @param Offer $offer
     *
     * @return bool
     */
    public function update(Offer $offer);

    /**
     * @param int $id
     *
     * @return Offer | object | null
     */
    public function getOfferById(int $id);
}