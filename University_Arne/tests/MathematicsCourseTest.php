<?php

/**
 * @covers MathematicsCourse
 */
class MathematicsCourseTest extends PHPUnit_Framework_TestCase
{
    public function testGetName()
    {
        $this->assertEquals('Mathematics', (new MathematicsCourse())->getName());
    }
}
