<?php

/**
 * @covers ComputingCourse
 * @covers AbstractCourse
 * @uses ModuleNameCollection
 */
class ComputingCourseTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var ComputingCourse
     */
    private $computingCourse;

    public function setUp()
    {
        $this->computingCourse = new ComputingCourse();
    }

    public function testCorrectModuleEntries()
    {
        $expected = [
            'Entity Relationship Modelling',
            'Web Development',
            'Database Systems',
            'First Level Support',
            'Network Infrastructure',
            'Colloquial English'
        ];

        foreach ($this->computingCourse->getModuleNames() as $key => $module) {
            $this->assertEquals($expected[$key], $module);
        }
    }

    public function testGetCourseName()
    {
        $this->assertEquals('Computing programmes', $this->computingCourse->getCourseName());
    }
}
