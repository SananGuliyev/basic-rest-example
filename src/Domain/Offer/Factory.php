<?php

namespace Webbala\Domain\Offer;

use Webbala\Domain\Models\Offer;

class Factory
{
    /**
     * @param array $data
     * @return Offer
     */
    public function createOfferFromArray(array $data)
    {
        $offer = new Offer(
            $data['name'],
            $data['discount']
        );

        return $offer;
    }
}