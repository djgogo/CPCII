<?php

/**
 * @covers FirstLevelSupport
 * @uses Lecturer
 * @uses Module
 */
class FirstLevelSupportTest extends PHPUnit_Framework_TestCase
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
        $this->assertEquals('First Level Support', (new FirstLevelSupport($this->lecturer))->getName());
    }

    public function testGetModuleNumber()
    {
        $this->assertEquals(112, (new FirstLevelSupport($this->lecturer))->getModuleNumber());
    }
}
