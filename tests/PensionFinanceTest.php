<?php

class PensionFinanceTest extends PHPUnit_Framework_TestCase
{
    public function testGetName()
    {
        $this->assertEquals('Pension Finance', (new PensionFinance())->getName());
    }

    public function testGetModuleNumber()
    {
        $this->assertEquals(208, (new PensionFinance())->getModuleNumber());
    }
}
