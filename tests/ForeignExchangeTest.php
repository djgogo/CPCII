<?php

/**
 * @covers ForeignExchange
 * @uses Lecturer
 * @uses Module
 */
class ForeignExchangeTest extends PHPUnit_Framework_TestCase
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
        $this->assertEquals('Foreign Exchange', (new ForeignExchange($this->lecturer))->getName());
    }

    public function testGetModuleNumber()
    {
        $this->assertEquals(203, (new ForeignExchange($this->lecturer))->getModuleNumber());
    }
}
