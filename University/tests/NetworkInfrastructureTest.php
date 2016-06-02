<?php

/**
 * @covers NetworkInfrastructure
 * @uses Lecturer
 * @uses Module
 */
class NetworkInfrastructureTest extends PHPUnit_Framework_TestCase
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
        $this->assertEquals('Network Infrastructure', (new NetworkInfrastructure($this->lecturer))->getName());
    }

    public function testGetModuleNumber()
    {
        $this->assertEquals(117, (new NetworkInfrastructure($this->lecturer))->getModuleNumber());
    }
}
