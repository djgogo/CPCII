<?php

/**
 * @covers Student
 * @uses EnrollmentNumber
 * @uses Course
 */
class StudentTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var EnrollmentNumber
     */
    private $enrollmentNumber;
    /**
     * @var Student
     */
    private $student;
    /**
     * @var Course
     */
    private $course;
    /**
     * @var string
     */
    private $name;

    public function setUp()
    {
        $this->name = 'Harry Potter';
        $this->enrollmentNumber = new EnrollmentNumber('123435f');
        $this->student = new Student($this->enrollmentNumber, $this->name);
        $this->course =  new Course('Test Course');
    }

    public function testGetEnrollmentNumberWorks()
    {
        $this->assertEquals($this->enrollmentNumber, $this->student->getEnrollmentNumber());
    }

    public function testGetName()
    {
        $this->assertEquals($this->name, $this->student->getName());
    }

    public function testStudentConversionToStringWorks()
    {
        $this->assertEquals('123435f', (string)$this->enrollmentNumber);
    }

    public function testSetCourse()
    {
        $this->student->setCourse($this->course);

        $this->assertEquals($this->course, $this->student->getCourse());
    }

    public function testStudentIsAlreadyEnrolledAndTryToEnrolAgain()
    {
        $this->student->setCourse($this->course);

        $this->expectException(RuntimeException::class);
        $this->student->setCourse($this->course);
    }
}
