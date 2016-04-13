<?php

class DatabaseSystemsTest extends PHPUnit_Framework_TestCase
{
    public function testGetName()
    {
        $this->assertEquals('Database Systems', (new DatabaseSystems())->getName());
    }

    public function testGetModuleNumber()
    {
        $this->assertEquals(105, (new DatabaseSystems())->getModuleNumber());
    }
}
