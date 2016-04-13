<?php

class ColloquialEnglishTest extends PHPUnit_Framework_TestCase
{
    public function testGetName()
    {
        $this->assertEquals('Colloquial English', (new ColloquialEnglish())->getName());
    }

    public function testGetModuleNumber()
    {
        $this->assertEquals(800, (new ColloquialEnglish())->getModuleNumber());
    }
}
