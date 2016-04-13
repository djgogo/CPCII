<?php

/**
 * @covers Course
 * @uses ModuleRepository
 * @uses ModuleFactory
 * @uses AbstractCourse
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
        $this->student = new Student(new EnrollmentNumber(), 'Test Student');

        $this->computingCourse = $this->courseBuilder->build(new ComputingCourse());
    }

    public function testGetNameWorks()
    {
        $computingCourse = $this->courseBuilder->build(new ComputingCourse());

        $this->assertEquals('Computing programmes', $computingCourse->getName());
    }

    public function testEnrolStudentAndGetEnrolledStudentsWorks()
    {
        $computingCourse = $this->courseBuilder->build(new ComputingCourse());
        $computingCourse->enrolStudent($this->student);

        $this->assertContains($this->student, $computingCourse->getEnrolledStudents());
    }
// TODO testGetModulesWorks
//    public function testGetModulesWorks()
//    {
//        $webDevelopment = new WebDevelopment();
//
//        $this->assertContains($webDevelopment, $this->computingCourse->getModules());
//
//    }
}
