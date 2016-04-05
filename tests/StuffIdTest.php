<?php


/**
 * @covers StuffId
 */
class StuffIdTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var int
     */
    private $stuffId;

    public function setUp()
    {
        $this->stuffId = new StuffId(12345);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testStuffIdIsNotIntegerThrowsException()
    {
        new StuffId('ae47');
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testStuffIdIsNotBiggerThanZeroThrowsException()
    {
        new StuffId(-10);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testStuffIdHasTheRightLengthThrowsException()
    {
        new StuffId(123456);
    }

    public function testStuffIdConvertionToStringWorks()
    {
        $this->assertEquals('12345', (string)$this->stuffId);
    }
}
