<?php
declare(strict_types = 1);

class ParticipantTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Participant
     */
    private $participant;

    public function setUp()
    {
        $this->participant = new Participant('foo', new Counter());
    }

    public function testIdCanBeRetrieved()
    {
        $this->assertInstanceOf('Id', $this->participant->getId());
    }

    public function testToParticipantCanBeAssignedAGrade()
    {
        $this->participant->addGrade('5.0');
        $this->assertEquals('5.0', $this->participant->getGrade());
    }
}

