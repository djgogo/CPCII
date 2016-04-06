<?php


class UpperBreadTest extends PHPUnit_Framework_TestCase
{
    public function testGetName()
    {
        $this->assertEquals('UpperBread', (new UpperBread)->getName());
    }

    public function testGetPrice()
    {
        $this->assertEquals('300', (string) (new UpperBread)->getPrice());
    }
}
