<?php

namespace Webbala\Infrastructure\Persistence\Doctrine;

use Webbala\Domain\Models\Offer;
use Webbala\Domain\Offer\RepositoryInterface;

class OfferRepository extends AbstractRepository implements RepositoryInterface
{

    /**
     * @return Offer[]
     */
    public function getAll()
    {
        return $this->entityManager->getRepository(Offer::class)->findAll();
    }

    /**
     * @param Offer $offer
     *
     * @return bool
     */
    public function save(Offer $offer)
    {
        return parent::saveEntity($offer);
    }

    /**
     * @param Offer $offer
     *
     * @return bool
     */
    public function update(Offer $offer)
    {
        return parent::updateEntity($offer);
    }

    /**
     * @param int $id
     *
     * @return Offer | object | null
     */
    public function getOfferById(int $id)
    {
        return $this->entityManager->getRepository(Offer::class)->findOneBy(['id' => $id]);
    }
}