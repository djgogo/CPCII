<?php

/**
 * @covers Course
 * @covers AbstractCourse
 * @uses ModuleRepository
 * @uses ModuleFactory
 * @uses ComputingCourse
 * @uses CourseBuilder
 * @uses ModuleNameCollection
 * @uses EnrollmentNumber
 * @uses Student
 */
class CourseTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var ModuleRepository
     */
    private $moduleRepository;
    /**
     * @var ModuleFactory
     */
    private $moduleFactory;
    /**
     * @var CourseBuilder
     */
    private $courseBuilder;
    /**
     * @var Student
     */
    private $student;
    /**
     * @var ComputingCourse
     */
    private $computingCourse;

    public function setUp()
    {
        $this->moduleFactory = $this->getMockBuilder(Modulefactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->moduleRepository = $this->getMockBuilder(ModuleRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->moduleRepository->addModule($this->moduleFactory->createWebDevelopmentModule());
        $this->courseBuilder = new CourseBuilder($this->moduleRepository);
        $this->computingCourse = $this->courseBuilder->build(new ComputingCourse());

        $this->student = new Student(new EnrollmentNumber(), 'Test Student');
    }

    public function testGetName()
    {
        $computingCourse = $this->courseBuilder->build(new ComputingCourse());

        $this->assertEquals('Computing programmes', $computingCourse->getName());
    }

    public function testEnrolStudentAndGetEnrolledStudents()
    {
        $computingCourse = $this->courseBuilder->build(new ComputingCourse());
        $computingCourse->enrolStudent($this->student);

        $this->assertContains($this->student, $computingCourse->getEnrolledStudents());
    }

    /**
     * TODO testGetModules() - check complete CourseTest and REFACTOR!
     */
//    public function testGetModules()
//    {
//        $webDevelopment = new WebDevelopment();
//
//        $this->assertContains($webDevelopment, $this->computingCourse->getModules());
//
//    }
}
