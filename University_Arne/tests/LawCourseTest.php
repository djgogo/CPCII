<?php

/**
 * @covers LawCourse
 */
class LawCourseTest extends PHPUnit_Framework_TestCase
{
    public function testGetName()
    {
        $this->assertEquals('Law', (new LawCourse())->getName());
    }
}
