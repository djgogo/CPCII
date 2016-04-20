<?php


class CourseBuilderTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var PHPUnit_Framework_MockObject_MockObject
     */
    private $moduleRepository;
    /**
     * @var PHPUnit_Framework_MockObject_MockObject
     */
    private $abstractCourse;

    public function setUp()
    {
        $this->moduleRepository = $this->getMockBuilder(ModuleRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->abstractCourse = $this->getMockBuilder(AbstractCourse::class)
            ->disableOriginalConstructor()
            ->getMock();

        $moduleNameCollection = [
            'Entity Relationship Modelling',
            'Web Development',
            'Database Systems',
            'First Level Support',
            'Network Infrastructure',
            'Colloquial English'
        ];
    }

    public function testBuildCourseWorks()
    {

    }
}
