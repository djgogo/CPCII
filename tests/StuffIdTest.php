<?php


/**
 * @covers StaffId
 */
class StuffIdTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var int
     */
    private $staffId;

    public function setUp()
    {
        $this->staffId = new StaffId(12345);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testStaffIdIsNotIntegerThrowsException()
    {
        new StaffId('ae47');
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testStaffIdIsNotBiggerThanZeroThrowsException()
    {
        new StaffId(-10);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testStaffIdHasTheRightLengthThrowsException()
    {
        new StaffId(123456);
    }

    public function testStaffIdConvertionToStringWorks()
    {
        $this->assertEquals('12345', (string)$this->staffId);
    }
}
