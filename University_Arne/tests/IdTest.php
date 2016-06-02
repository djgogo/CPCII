<?php

/**
 * @covers Id
 * @covers UUID
 */
class IDTest extends PHPUnit_Framework_TestCase
{
    public function testGeneratedIDMatchesLength()
    {
        $uuid = new Id();
        $this->assertEquals(36, strlen((string)$uuid));
    }

    public function testGeneratedIDIsNotEmpty()
    {
        $uuid = new Id();
        $this->assertNotEmpty($uuid);
    }
}
