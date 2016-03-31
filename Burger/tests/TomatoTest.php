<?php


class TomatoTest extends PHPUnit_Framework_TestCase
{
    public function testGetName()
    {
        $this->assertEquals('Tomato', (new Tomato)->getName());
    }

    public function testGetPrice()
    {
        $this->assertEquals('50', (string) (new Tomato)->getPrice());
    }
}
