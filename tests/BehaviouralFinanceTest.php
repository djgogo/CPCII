<?php

class BehaviouralFinanceTest extends PHPUnit_Framework_TestCase
{
    public function testGetName()
    {
        $this->assertEquals('Behavioural Finance', (new BehaviouralFinance())->getName());
    }

    public function testGetModuleNumber()
    {
        $this->assertEquals(220, (new BehaviouralFinance())->getModuleNumber());
    }
}
