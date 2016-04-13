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
    /**
     * @var string
     */
    private $name;

    public function setUp()
    {
        $this->name = 'Harry Potter';
        $this->newId = new EnrollmentNumber('123435f');
        $this->student = new Student($this->newId, $this->name);
    }

    public function testGetEnrollmentNumberWorks()
    {
        $this->assertEquals($this->newId, $this->student->getEnrollmentNumber());
    }

    public function testGetName()
    {
        $this->assertEquals($this->name, $this->student->getName());
    }

    public function testStudentConversionToStringWorks()
    {
        $this->assertEquals('123435f', (string)$this->newId);
    }
}
