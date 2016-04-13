<?php

class EnergyMarketsTest extends PHPUnit_Framework_TestCase
{
    public function testGetName()
    {
        $this->assertEquals('Energy Markets', (new EnergyMarkets())->getName());
    }

    public function testGetModuleNumber()
    {
        $this->assertEquals(201, (new EnergyMarkets())->getModuleNumber());
    }
}
