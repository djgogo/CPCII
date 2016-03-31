<?php


class CheeseTest extends PHPUnit_Framework_TestCase
{
    public function testGetName()
    {
        $this->assertEquals('Cheese', (new Cheese)->getName());
    }

    public function testGetPrice()
    {
        $this->assertEquals('100', (string) (new Cheese)->getPrice());
    }
}
