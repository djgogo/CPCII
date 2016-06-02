<?php

/**
 * @covers Module
 * @uses Lecturer
 * @uses StaffId
 */
class ModuleTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Lecturer
     */
    private $lecturer;
    /**
     * @var Course
     */
    private $course;
    /**
     * @var Module
     */
    private $module;
    /**
     * @var
     */
    private $staffId;

    public function setUp()
    {
        $this->lecturer = $this->getMockBuilder(Lecturer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->course = $this->getMockBuilder(Course::class)
                ->disableOriginalConstructor()
                ->getMock();

        $this->staffId = $this->getMockBuilder(StaffId::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->module = new WebDevelopment($this->lecturer);
    }

    public function testGetLecturer()
    {
        $lecturer = New Lecturer($this->staffId, 'Lisa Millet');
        $this->module->setLecturer($lecturer);
        $this->assertEquals($lecturer, $this->module->getLecturer());
    }
}
