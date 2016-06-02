<?php

/**
 * @covers PsychologyCourse
 */
class PsychologyCourseTest extends PHPUnit_Framework_TestCase
{
    public function testGetName()
    {
        $this->assertEquals('Psychology', (new PsychologyCourse())->getName());
    }
}
