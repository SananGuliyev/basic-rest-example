<?php

namespace Webbala\Domain\Services;

use PHPUnit\Framework\TestCase;

class CodeGeneratorTest extends TestCase
{
    /**
     * @test
     */
    public function generateTest()
    {
        // prepare
        $codeLength = 8;
        $expectedResult = 8;

        // test
        $classUnderTest = new CodeGenerator();
        $result = $classUnderTest->generate($codeLength);

        // verify
        $this->assertEquals($expectedResult, strlen($result));
    }
}