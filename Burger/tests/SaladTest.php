<?php


class SaladTest extends PHPUnit_Framework_TestCase
{
    public function testGetName()
    {
        $this->assertEquals('Salad', (new Salad)->getName());
    }

    public function testGetPrice()
    {
        $this->assertEquals('80', (string) (new Salad)->getPrice());
    }
}
