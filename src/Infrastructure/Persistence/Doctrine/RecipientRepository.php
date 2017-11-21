<?php

namespace Webbala\Infrastructure\Persistence\Doctrine;

use Webbala\Domain\Models\Recipient;
use Webbala\Domain\Recipient\RepositoryInterface;

class RecipientRepository extends AbstractRepository implements RepositoryInterface
{

    /**
     * @return Recipient[]
     */
    public function getAll()
    {
        return $this->entityManager->getRepository(Recipient::class)->findAll();
    }

    /**
     * @param Recipient $recipient
     *
     * @return bool
     */
    public function save(Recipient $recipient)
    {
        return parent::saveEntity($recipient);
    }

    /**
     * @param Recipient $recipient
     *
     * @return bool
     */
    public function update(Recipient $recipient)
    {
        return parent::updateEntity($recipient);
    }

    /**
     * @param int $id
     *
     * @return Recipient | object | null
     */
    public function getRecipientById(int $id)
    {
        // TODO: Implement getReportById() method.
    }

    /**
     * @param string $email
     * @return Recipient | object | null
     */
    public function getRecipientByEmail(string $email)
    {
        return $this->entityManager
            ->getRepository(Recipient::class)
            ->findOneBy(['email' => $email]);
    }
}