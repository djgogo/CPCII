<?php

/**
 * @covers LatinCourse
 */
class LatinCourseTest extends PHPUnit_Framework_TestCase
{
    public function testGetName()
    {
        $this->assertEquals('Latin', (new LatinCourse())->getName());
    }
}
