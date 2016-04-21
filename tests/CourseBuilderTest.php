<?php

/**
 * @covers CourseBuilder
 * @uses ModuleRepository
 * @uses AbstractCourse
 * @uses ModuleNameCollection
 * @uses Course
 * @uses Module
 */
class CourseBuilderTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var ModuleRepository
     */
    private $moduleRepository;
    /**
     * @var AbstractCourse
     */
    private $abstractCourse;
    /**
     * @var ModuleNameCollection
     */
    private $moduleNameCollection;

    public function setUp()
    {
        $this->moduleRepository = $this->getMockBuilder(ModuleRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->abstractCourse = $this->getMockBuilder(AbstractCourse::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->moduleNameCollection = new ModuleNameCollection();
    }

    public function testNoModulesInCollectionListThrowsException()
    {
        $this->expectException(RuntimeException::class);

        $courseBuilder = new CourseBuilder($this->moduleRepository);
        $courseBuilder->build($this->abstractCourse);
    }

    public function testBuildCourseWorks()
    {
        $this->moduleNameCollection->add('Web Development');
        $this->moduleNameCollection->add('Database Systems');
        $this->moduleNameCollection->add('First Level Support');

        $webDevelopment = new WebDevelopment();
        $databaseSystems = new DatabaseSystems();
        $firstLevelSupport = new FirstLevelSupport();

        $this->moduleRepository
            ->expects($this->at(0))
            ->method('getModule')
            ->willReturn($webDevelopment);

        $this->moduleRepository
            ->expects($this->at(1))
            ->method('getModule')
            ->willReturn($databaseSystems);

        $this->moduleRepository
            ->expects($this->at(2))
            ->method('getModule')
            ->willReturn($firstLevelSupport);

        $this->abstractCourse
            ->expects($this->once())
            ->method('getModuleNames')
            ->willReturn($this->moduleNameCollection);

        $courseBuilder = new CourseBuilder($this->moduleRepository);
        $course = $courseBuilder->build($this->abstractCourse);

        $this->assertEquals(
            [$webDevelopment, $databaseSystems, $firstLevelSupport],
            $course->getModules()
        );

    }
}
