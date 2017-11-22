<?php

namespace Webbala\Domain\Recipient;

use PHPUnit\Framework\TestCase;
use Webbala\Domain\Models\Recipient;

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
            'email' => 'some@email.com'
        ];

        // test
        $classUnderTest = new Factory();
        $result = $classUnderTest->createRecipientFromArray($data);

        // verify
        $this->assertInstanceOf(Recipient::class, $result);
        $this->assertEquals($result->getName(), $data['name']);
        $this->assertEquals($result->getEmail(), $data['email']);
    }
}