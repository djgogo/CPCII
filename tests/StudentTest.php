<?php

/**
 * @covers Student
 * @uses EnrollmentNumber
 */
class StudentTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var EnrollmentNumber
     */
    private $newId;
    /**
     * @var Student
     */
    private $student;

    public function setUp()
    {
        $this->newId = new EnrollmentNumber('123435f');
        $this->student = new Student($this->newId);
    }

    public function testGetEnrollmentNumberWorks()
    {
        $this->assertEquals($this->newId, $this->student->getEnrollmentNumber());
    }

    public function testStudentConvertionToStringWorks()
    {
        $this->assertEquals('123435f', (string)$this->newId);
    }
}
