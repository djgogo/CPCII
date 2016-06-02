<?php

/**
 * @covers Semester
 * @covers AbstractSemester
 */
class AbstractSemesterTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var PHPUnit_Framework_MockObject_MockObject|\AbstractSemester
     */
    private $abstractSemester;

    public function setUp()
    {
        $this->abstractSemester = $this->getMockForAbstractClass(AbstractSemester::class);
    }

    public function testCoursesCanBeRetrieved()
    {
        $courses = [
            $this->getMockBuilder(ComputingCourse::class)->disableOriginalConstructor()->getMock(),
            $this->getMockBuilder(PhysicsCourse::class)->disableOriginalConstructor()->getMock()
        ];

        $this->abstractSemester
            ->expects($this->once())
            ->method('createCourses')
            ->willReturn($courses);

       $this->assertEquals($courses, $this->abstractSemester->getCourses());

        return ['semester' => $this->abstractSemester, 'courses' => $courses];
    }

    /**
     * @depends testCoursesCanBeRetrieved
     */
    public function testCourseCanBeRetrievedByIdentifier(array $currentData)
    {

        /** @var AbstractSemester $abstractSemester */
        $abstractSemester = $currentData['semester'];
        $courses = $currentData['courses'];

        $courses[0]
            ->expects($this->once())
            ->method('getName')
            ->willReturn('another');

        $courses[1]
            ->expects($this->once())
            ->method('getName')
            ->willReturn('computing');

        $this->assertEquals($courses[1], $abstractSemester->getCourse('computing'));
    }

    public function testGetCourseWithWrongNameThrowsException()
    {
        $this->expectException('RuntimeException');
        $this->abstractSemester->getCourse('Wrong Course');
    }
}
