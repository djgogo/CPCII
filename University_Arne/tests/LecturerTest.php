<?php

/**
 * @covers Lecturer
 * @uses StaffId
 * @uses UUID
 * @uses Id
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
        $this->staffId = new Staffid(12345);
        $this->lecturer = new Lecturer($this->staffId, 'John Doe');
    }

    public function testGetStaffId()
    {
        $this->assertEquals('12345', $this->lecturer->getStaffId());
    }

    public function testGetNameWorks()
    {
        $this->assertEquals('John Doe', $this->lecturer->getName());
    }
}
