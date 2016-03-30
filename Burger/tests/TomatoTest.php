<?php


class TomatoTest extends PHPUnit_Framework_TestCase
{
    public function testGetName()
    {
        $this->assertEquals('Tomato', (new Tomato)->getName());
    }
}
