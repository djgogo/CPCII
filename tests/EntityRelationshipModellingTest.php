<?php

class EntityRelationshipModellingTest extends PHPUnit_Framework_TestCase
{
    public function testGetName()
    {
        $this->assertEquals('Entity Relationship Modelling', (new EntityRelationshipModelling())->getName());
    }

    public function testGetModuleNumber()
    {
        $this->assertEquals(100, (new EntityRelationshipModelling())->getModuleNumber());
    }
}
