<?php


class CheeseTest extends PHPUnit_Framework_TestCase
{
    public function testGetName()
    {
        $this->assertEquals('Cheese', (new Cheese)->getName());
    }
}
