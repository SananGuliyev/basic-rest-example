<?php

namespace Webbala\Domain\Recipient;

use Webbala\Domain\Models\Recipient;

interface RepositoryInterface
{
    /**
     * @return Recipient[]
     */
    public function getAll();

    /**
     * @param Recipient $recipient
     *
     * @return bool
     */
    public function save(Recipient $recipient);

    /**
     * @param Recipient $recipient
     *
     * @return bool
     */
    public function update(Recipient $recipient);

    /**
     * @param int $id
     *
     * @return Recipient | object | null
     */
    public function getRecipientById(int $id);

    /**
     * @param string $email
     * @return Recipient | object | null
     */
    public function getRecipientByEmail(string $email);
}