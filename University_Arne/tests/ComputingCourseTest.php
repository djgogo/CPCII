<?php

/**
 * @covers ComputingCourse
 */
class ComputingCourseTest extends PHPUnit_Framework_TestCase
{
    public function testGetName()
    {
        $this->assertEquals('Computing programmes', (new ComputingCourse())->getName());
    }
}
