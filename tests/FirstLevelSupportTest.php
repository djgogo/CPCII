<?php

class FirstLevelSupportTest extends PHPUnit_Framework_TestCase
{
    public function testGetName()
    {
        $this->assertEquals('First Level Support', (new FirstLevelSupport())->getName());
    }

    public function testGetModuleNumber()
    {
        $this->assertEquals(112, (new FirstLevelSupport())->getModuleNumber());
    }
}
