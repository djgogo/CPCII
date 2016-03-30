<?php


class UpperBreadTest extends PHPUnit_Framework_TestCase
{
    public function testGetName()
    {
        $this->assertEquals('UpperBread', (new UpperBread)->getName());
    }
}
