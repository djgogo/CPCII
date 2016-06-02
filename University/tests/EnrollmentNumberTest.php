<?php

/**
 * @covers EnrollmentNumber
 */
class EnrollmentNumberTest extends PHPUnit_Framework_TestCase
{
    public function testConstructorWithGivenEnrollmentNumber()
    {
        $enrollmentNumber = new EnrollmentNumber('123456g');

        $this->assertEquals('123456g', (string)$enrollmentNumber);

    }

    public function testConstructorIfEnrollmentNumberIsNullWorks()
    {
        $enrollmentNumber = new EnrollmentNumber();

        $this->assertNotNull((string)$enrollmentNumber);

    }
}
