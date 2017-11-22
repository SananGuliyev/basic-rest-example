<?php

namespace Webbala\Domain\Models;

use PHPUnit\Framework\TestCase;

class VoucherTest extends TestCase
{
    /**
     * @test
     */
    public function constructTest()
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

        // test
        $classUnderTest = new Voucher(
            $offerMock,
            $recipientMock,
            $code,
            $expiration,
            $isUsed,
            $usedAt
        );

        // verify
        $this->assertInstanceOf(Voucher::class, $classUnderTest);
    }
}