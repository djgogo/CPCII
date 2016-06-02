<?php

/**
 * @covers Student
 * @uses Course
 * @uses UUID
 * @uses Id
 */
class StudentTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Course
     */
    private $course;
    /**
     * @var Course
     */
    private $course2;
    /**
     * @var Student
     */
    private $student;
    /**
     * @var Id
     */
    private $EnrollmentNumber;

    public function setUp()
    {
        $this->course = $this->getMockBuilder(Course::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->course2 = new LawCourse();

        $this->EnrollmentNumber = new Id();
        $this->student = new Student($this->EnrollmentNumber, 'Harry Potter');
    }

    public function testEnrollmentNumberCanBeRetrieved()
    {
        $this->assertInstanceOf('Id', $this->student->getEnrollmentNumber());
    }

    public function testNameCanBeRetrieved()
    {
        $this->assertEquals('Harry Potter', $this->student->getName());
    }

    public function testStudentCanBeEnrolledToCourse()
    {
        $this->student->enrolToCourse($this->course);

        $this->assertTrue(in_array($this->course, $this->student->getCourses()));
    }

    public function testStudentIsAlreadyEnrolledAndTryToEnrolAgainThrowsException()
    {
        $this->student->enrolToCourse($this->course);

        $this->expectException(RuntimeException::class);
        $this->student->enrolToCourse($this->course);
    }

    public function testStudentCanEnrollInManyCourses()
    {
        $this->student->enrolToCourse($this->course);
        $this->student->enrolToCourse($this->course2);

        $this->assertContains($this->course, $this->student->getCourses());
        $this->assertContains($this->course2, $this->student->getCourses());
    }
}
