<?php

/**
 * @covers ColloquialEnglish
 * @uses Lecturer
 * @uses Module
 */
class ColloquialEnglishTest extends PHPUnit_Framework_TestCase
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
        $this->assertEquals('Colloquial English', (new ColloquialEnglish($this->lecturer))->getName());
    }

    public function testGetModuleNumber()
    {
        $this->assertEquals(800, (new ColloquialEnglish($this->lecturer))->getModuleNumber());
    }
}
