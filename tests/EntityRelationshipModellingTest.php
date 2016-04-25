<?php

/**
 * @covers EntityRelationshipModelling
 * @uses Lecturer
 * @uses Module
 */
class EntityRelationshipModellingTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Lecturer
     */
    private $lecturer;

    public function setUp()
    {
        $this->lecturer = $this->getMockBuilder(Lecturer::class)
            ->disableOriginalConstructor()
            ->getMock();
    }

    public function testGetName()
    {
        $this->assertEquals('Entity Relationship Modelling', (new EntityRelationshipModelling($this->lecturer))->getName());
    }

    public function testGetModuleNumber()
    {
        $this->assertEquals(100, (new EntityRelationshipModelling($this->lecturer))->getModuleNumber());
    }
}
