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

    public function setUp()
    {
        $this->staffId = new StaffId(12345);
        $this->lecturer = new Lecturer($this->staffId);
    }

    public function testGetStaffIdWorks()
    {
        $this->assertEquals($this->staffId, $this->lecturer->getStaffId());
    }

    public function testLecturerConvertionToStringWorks()
    {
        $this->assertSame('12345', (string)$this->staffId);
    }
}
