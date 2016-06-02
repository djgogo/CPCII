<?php

/**
 * @covers PhysicsCourse
 */
class PhysicsCourseTest extends PHPUnit_Framework_TestCase
{
    public function testGetName()
    {
        $this->assertEquals('Physics', (new PhysicsCourse())->getName());
    }
}
