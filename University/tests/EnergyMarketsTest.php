<?php

/**
 * @covers EnergyMarkets
 * @uses Lecturer
 * @uses Module
 */
class EnergyMarketsTest extends PHPUnit_Framework_TestCase
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
        $this->assertEquals('Energy Markets', (new EnergyMarkets($this->lecturer))->getName());
    }

    public function testGetModuleNumber()
    {
        $this->assertEquals(201, (new EnergyMarkets($this->lecturer))->getModuleNumber());
    }
}
