<?php

namespace Webbala\Domain\Models;

use PHPUnit\Framework\TestCase;

class RecipientTest extends TestCase
{
    /**
     * @test
     */
    public function constructTest()
    {
        // prepare
        $name = 'Some amazing name';
        $email = 'some@email.com';

        // test
        $classUnderTest = new Recipient($name, $email);

        // verify
        $this->assertInstanceOf(Recipient::class, $classUnderTest);
    }
}