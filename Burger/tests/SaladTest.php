<?php


class SaladTest extends PHPUnit_Framework_TestCase
{
    public function testGetName()
    {
        $this->assertEquals('Salad', (new Salad)->getName());
    }
}
