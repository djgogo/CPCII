<?php

class NetworkInfrastructureTest extends PHPUnit_Framework_TestCase
{
    public function testGetName()
    {
        $this->assertEquals('Network Infrastructure', (new NetworkInfrastructure())->getName());
    }

    public function testGetModuleNumber()
    {
        $this->assertEquals(117, (new NetworkInfrastructure())->getModuleNumber());
    }
}
