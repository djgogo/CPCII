<?php


class SauceTest extends PHPUnit_Framework_TestCase
{
    public function testGetName()
    {
        $this->assertEquals('Sauce', (new Sauce)->getName());
    }

    public function testGetPrice()
    {
        $this->assertEquals('50', (string) (new Sauce)->getPrice());
    }
}
