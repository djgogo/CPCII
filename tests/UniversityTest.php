<?php

/**
 * @covers University
 * @uses StuffId
 */
class UniversityTest extends PHPUnit_Framework_TestCase
{
    public function testGetName()
    {
        $university = new University('Cambridge');
        $this->assertEquals('Cambridge', $university->getName());
    }

    public function testGenerateRandomNumericFiveCharacterStuffIdWorks()
    {
        $university = new University('Cambridge');
        $this->assertInstanceOf('StuffId', $university->generateRandomNumericFiveCharacterStuffId());
    }
}
