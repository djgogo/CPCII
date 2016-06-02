<?php

/**
 * @covers WebDevelopment
 * @uses Lecturer
 * @uses Module
 */
class WebDevelopmentTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Lecturer
     */
    private $lecturer;

    public function setUp()
    {
        $this->lecturer = $this->getMockBuilder(Lecturer::class)
            ->disableOriginalConstructor()
            ->getMock();
    }

    public function testGetName()
    {
        $this->assertEquals('Web Development', (new WebDevelopment($this->lecturer))->getName());
    }

    public function testGetModuleNumber()
    {
        $this->assertEquals(101, (new WebDevelopment($this->lecturer))->getModuleNumber());
    }
}
