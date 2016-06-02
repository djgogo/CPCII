<?php

/**
 * @covers Course
 * @uses Student
 * @uses PsychologyCourse
 */
class CourseTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Course
     */
    private $course;
    /**
     * @var Student
     */
    private $student;

    public function setUp()
    {
        $this->student = $this->getMockBuilder(Student::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->course = new PsychologyCourse();
    }

    public function testNameCanBeRetrieved()
    {
        $this->assertEquals('Psychology', $this->course->getName());
    }

    public function testStudentCanBeEnrolledAndRetrieved()
    {
        $this->course->enrolStudent($this->student);
        $this->assertContains($this->student, $this->course->getEnrolledStudents());
    }
}
