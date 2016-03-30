<?php


class PattyTest extends PHPUnit_Framework_TestCase
{
    public function testGetName()
    {
        $this->assertEquals('Patty', (new Patty)->getName());
    }
}
