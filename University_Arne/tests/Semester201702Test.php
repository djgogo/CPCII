<?php

/**
 * @covers Semester201702
 * @uses AbstractSemester
 */
class Semester201702Test extends PHPUnit_Framework_TestCase
{
    /**
     * @var Semester201702
     */
    private $semester201702;

    public function setUp()
    {
        $this->semester201702 = new Semester201702();
    }

    public function testCorrectCourseEntries()
    {
        $expected = [
            new LawCourse(),
            new MathematicsCourse(),
            new LatinCourse()
        ];

        $this->assertEquals($expected, $this->semester201702->getCourses());
    }

    public function testGetName()
    {
        $this->assertEquals('2017-02', $this->semester201702->getName());
    }
}
