<?php

/**
 * @covers University
 * @uses StaffId
 */
class UniversityTest extends PHPUnit_Framework_TestCase
{
    public function testGetName()
    {
        $university = new University('Cambridge');
        $this->assertEquals('Cambridge', $university->getName());
    }

    public function testGenerateRandomNumericFiveCharacterStaffIdWorks()
    {
        $university = new University('Cambridge');
        $this->assertInstanceOf('StaffId', $university->generateRandomNumericFiveCharacterStaffId());
    }
}
