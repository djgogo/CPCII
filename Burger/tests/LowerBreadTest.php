<?php


class LowerBreadTest extends PHPUnit_Framework_TestCase
{
    public function testGetName()
    {
        $this->assertEquals('LowerBread', (new LowerBread)->getName());
    }

    public function testGetPrice()
    {
        $this->assertEquals('300', (string) (new LowerBread)->getPrice());
    }
}
