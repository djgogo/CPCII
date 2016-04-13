<?php


class CreditRiskManagementTest extends PHPUnit_Framework_TestCase
{
    public function testGetName()
    {
        $this->assertEquals('Credit Risk Management', (new CreditRiskManagement())->getName());
    }

    public function testGetModuleNumber()
    {
        $this->assertEquals(200, (new CreditRiskManagement())->getModuleNumber());
    }
}
