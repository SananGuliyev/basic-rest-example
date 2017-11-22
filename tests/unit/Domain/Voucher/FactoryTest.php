<?php

namespace Webbala\Domain\Voucher;

use PHPUnit\Framework\TestCase;
use Webbala\Domain\Models\Offer;
use Webbala\Domain\Models\Recipient;
use Webbala\Domain\Models\Voucher;

class FactoryTest extends TestCase
{
    /**
     * @test
     */
    public function createOfferFromArrayTest()
    {
        // prepare
        /** @var Offer $offerMock */
        $offerMock = $this->createMock(Offer::class);

        /** @var Recipient $recipientMock */
        $recipientMock = $this->createMock(Recipient::class);

        $code = 'someAmazingCode';
        $expiration = new \DateTime();
        $isUsed = 0;
        $usedAt = null;

        $data = [
            'offer' => $offerMock,
            'recipient' => $recipientMock,
            'code' => $code,
            'expiration' => $expiration,
            'isUsed' => $isUsed,
            'usedAt' => $usedAt
        ];

        // test
        $classUnderTest = new Factory();
        $result = $classUnderTest->createVoucherFromArray($data);

        // verify
        $this->assertInstanceOf(Voucher::class, $result);
        $this->assertEquals($result->getOffer(), $data['offer']);
        $this->assertEquals($result->getRecipient(), $data['recipient']);
        $this->assertEquals($result->getCode(), $data['code']);
        $this->assertEquals($result->getExpiration(), $data['expiration']);
        $this->assertEquals($result->getIsUsed(), $data['isUsed']);
        $this->assertEquals($result->getUsedAt(), $data['usedAt']);
    }
}