<?php


/**
 * @covers StaffId
 */
class StaffIdTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var int
     */
    private $staffId;

    public function setUp()
    {
        $this->staffId = new StaffId(12345);
    }

    public function testStaffIdIsNotBiggerThanZeroThrowsException()
    {
        $this->expectException('InvalidArgumentException');

        new StaffId(-10);
    }

    public function testStaffIdHasNotTheRightLengthThrowsException()
    {
        $this->expectException('InvalidArgumentException');

        new StaffId(123456);
    }

    public function testStaffIdConversionToStringWorks()
    {
        $this->assertEquals('12345', (string)$this->staffId);
    }
}
