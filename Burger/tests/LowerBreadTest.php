<?php


class LowerBreadTest extends PHPUnit_Framework_TestCase
{
    public function testGetName()
    {
        $this->assertEquals('LowerBread', (new LowerBread)->getName());
    }
}
