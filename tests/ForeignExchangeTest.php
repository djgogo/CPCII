<?php

class ForeignExchangeTest extends PHPUnit_Framework_TestCase
{
    public function testGetName()
    {
        $this->assertEquals('Foreign Exchange', (new ForeignExchange())->getName());
    }

    public function testGetModuleNumber()
    {
        $this->assertEquals(203, (new ForeignExchange())->getModuleNumber());
    }
}
