<?php

/**
 * @covers DatabaseSystems
 * @uses Lecturer
 * @uses Module
 */
class DatabaseSystemsTest extends PHPUnit_Framework_TestCase
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
        $this->assertEquals('Database Systems', (new DatabaseSystems($this->lecturer))->getName());
    }

    public function testGetModuleNumber()
    {
        $this->assertEquals(105, (new DatabaseSystems($this->lecturer))->getModuleNumber());
    }
}
