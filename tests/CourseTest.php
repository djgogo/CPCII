<?php

/**
 * @covers Course
 * @uses Student
 * @uses Module
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
    /**
     * @var WebDevelopment
     */
    private $webDevelopment;
    /**
     * @var DatabaseSystems
     */
    private $databaseSystems;
    /**
     * @var FirstLevelSupport
     */
    private $firstLevelSupport;

    public function setUp()
    {
        $this->webDevelopment = new WebDevelopment();
        $this->databaseSystems = new DatabaseSystems();
        $this->firstLevelSupport = new FirstLevelSupport();

        $this->course = new Course('Computing programmes',
            $this->webDevelopment,
            $this->databaseSystems,
            $this->firstLevelSupport
        );

        $this->student = $this->getMockBuilder(Student::class)
            ->disableOriginalConstructor()
            ->getMock();
    }

    public function testGetName()
    {
        $this->assertEquals('Computing programmes', $this->course->getName());
    }

    public function testEnrolStudentAndGetEnrolledStudents()
    {
        $this->course->enrolStudent($this->student);
        $this->assertContains($this->student, $this->course->getEnrolledStudents());
    }

    public function testGetModules()
    {
        $this->assertEquals(
            [$this->webDevelopment, $this->databaseSystems, $this->firstLevelSupport],
            $this->course->getModules()
        );
    }
}
