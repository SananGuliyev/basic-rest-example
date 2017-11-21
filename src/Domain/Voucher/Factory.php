<?php

namespace Webbala\Domain\Voucher;

use Webbala\Domain\Models\Voucher;

class Factory
{
    /**
     * @param array $data
     * @return Voucher
     */
    public function createVoucherFromArray(array $data)
    {
        $offer = new Voucher(
            $data['offer'],
            $data['recipient'],
            $data['code'],
            $data['expiration'],
            $data['isUsed'],
            $data['usedAt']
        );

        return $offer;
    }
}