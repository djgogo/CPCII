<?php

class EnrollmentNumberTest extends PHPUnit_Framework_TestCase
{
    /**
     * @expectedException InvalidArgumentException
     */
    public function testEnrollmentNumberIsNotIntegerThrowsException()
    {
        new EnrollmentNumber('a7');
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testEnrollmentNumberIsNotBiggerThanZeroThrowsException()
    {
        new EnrollmentNumber(-2);
    }
}
