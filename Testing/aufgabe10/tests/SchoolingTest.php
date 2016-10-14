<?php
declare(strict_types = 1);

class SchoolingTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Schooling
     */
    private $schooling;

    /**
     * @var Counter
     */
    private $counter;

    public function setUp()
    {
        $this->counter = new Counter();
        $this->schooling = new Schooling();
    }

    public function testParticipantsCanBeAdded()
    {
        $this->schooling->addParticipant(new Participant('foo', $this->counter));
        $this->assertEquals(1, count($this->schooling->getParticipants()));
    }

    public function testMaximum12ParticipantsAreAllowed()
    {
        $this->expectException('InvalidSchoolingException');
        $x = 1;
        while ($x <= 13) {
            $this->schooling->addParticipant(new Participant("Participant_$x", $this->counter));
            $x++;
        }
    }

    public function testParticipantsGradeCanBeRetrievedById()
    {
        $participant = new Participant('foo', $this->counter);
        $participant->addGrade('6.0');

        $this->schooling->addParticipant($participant);
        $grade = $this->schooling->getParticipantsGrade($participant->getId());

        $this->assertEquals($grade, $participant->getGrade());
    }

    public function testListWithAllParticipantsAndTheirGradesCanBePrinted()
    {
        $this->expectOutputString('Teilnehmer: foo Note: 4.5');

        $participant = new Participant('foo', $this->counter);
        $this->schooling->addParticipant($participant);
        $participant->addGrade('4.5');

        $this->schooling->printParticipants();
    }
}

