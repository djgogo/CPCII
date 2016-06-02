<?php

/**
 * @covers Semester201701
 * @uses AbstractSemester
 */
class Semester201701Test extends PHPUnit_Framework_TestCase
{
    /**
     * @var Semester201701
     */
    private $semester201701;

    public function setUp()
    {
        $this->semester201701 = new Semester201701();
    }

    public function testCorrectCourseEntries()
    {
        $expected = [
            new ComputingCourse(),
            new PhysicsCourse(),
            new PsychologyCourse()
        ];

        $this->assertEquals($expected, $this->semester201701->getCourses());
    }

    public function testGetName()
    {
        $this->assertEquals('2017-01', $this->semester201701->getName());
    }
}
