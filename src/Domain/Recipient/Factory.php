<?php

namespace Webbala\Domain\Recipient;

use Webbala\Domain\Models\Recipient;

class Factory
{
    /**
     * @param array $data
     * @return Recipient
     */
    public function createRecipientFromArray(array $data)
    {
        $recipient = new Recipient(
            $data['name'],
            $data['email']
        );

        return $recipient;
    }
}