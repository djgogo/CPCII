<?php

/**
 * @covers Lecturer
 * @uses StaffId
 */
class LecturerTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Lecturer
     */
    private $lecturer;
    /**
     * @var StaffId
     */
    private $staffId;
    /**
     * @var string
     */
    private $name;

    public function setUp()
    {
        $this->name = 'John Doe';
        $this->staffId = new StaffId(12345);
        $this->lecturer = new Lecturer($this->staffId, $this->name);
    }

    public function testGetStaffIdWorks()
    {
        $this->assertEquals($this->staffId, $this->lecturer->getStaffId());
    }

    public function testGetName()
    {
        $this->assertEquals($this->name, $this->lecturer->getName());
    }

    public function testLecturerConversionToStringWorks()
    {
        $this->assertSame('12345', (string)$this->staffId);
    }
}
