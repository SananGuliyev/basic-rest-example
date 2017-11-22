<?php

namespace Webbala\Domain\Offer;

use PHPUnit\Framework\TestCase;
use Webbala\Domain\Models\Offer;

class FactoryTest extends TestCase
{
    /**
     * @test
     */
    public function createOfferFromArrayTest()
    {
        // prepare
        $data = [
            'name' => 'Some amazing name',
            'discount' => 77
        ];

        // test
        $classUnderTest = new Factory();
        $result = $classUnderTest->createOfferFromArray($data);

        // verify
        $this->assertInstanceOf(Offer::class, $result);
        $this->assertEquals($result->getName(), $data['name']);
        $this->assertEquals($result->getDiscount(), $data['discount']);
    }
}