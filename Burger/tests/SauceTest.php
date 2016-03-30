<?php


class SauceTest extends PHPUnit_Framework_TestCase
{
    public function testGetName()
    {
        $this->assertEquals('Sauce', (new Sauce)->getName());
    }
}
