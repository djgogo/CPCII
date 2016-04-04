<?php


class StudentTest extends PHPUnit_Framework_TestCase
{
    public function testGetEnrollmentNumberWorks()
    {
        $newId = new EnrollmentNumber(1);
        $student = new Student($newId);
        $this->assertEquals($newId, $student->getEnrollmentNumber());
    }
}
