<?php

namespace Webbala\Domain\Models;

use PHPUnit\Framework\TestCase;

class OfferTest extends TestCase
{
    /**
     * @test
     */
    public function constructTest()
    {
        // prepare
        $name = 'Some amazing name';
        $discount = 77;

        // test
        $classUnderTest = new Offer($name, $discount);

        // verify
        $this->assertInstanceOf(Offer::class, $classUnderTest);
    }
}