<?php

class WebDevelopmentTest extends PHPUnit_Framework_TestCase
{
    public function testGetName()
    {
        $this->assertEquals('Web Development', (new WebDevelopment())->getName());
    }

    public function testGetModuleNumber()
    {
        $this->assertEquals(101, (new WebDevelopment())->getModuleNumber());
    }
}
