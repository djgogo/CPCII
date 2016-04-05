<?php

/**
 * @covers Lecturer
 * @uses StuffId
 */
class LecturerTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Lecturer
     */
    private $lecturer;
    /**
     * @var StuffId
     */
    private $stuffId;

    public function setUp()
    {
        $this->stuffId = new StuffId(12345);
        $this->lecturer = new Lecturer($this->stuffId);
    }

    public function testGetStuffIdWorks()
    {
        $this->assertEquals($this->stuffId, $this->lecturer->getStuffId());
    }

    public function testLecturerConvertionToStringWorks()
    {
        $this->assertSame('12345', (string)$this->stuffId);
    }
}
