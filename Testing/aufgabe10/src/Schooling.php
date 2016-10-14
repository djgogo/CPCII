<?php
declare(strict_types = 1);

class Schooling
{
    /**
     * @var array
     */
    private $participants = [];

    public function addParticipant(Participant $participant)
    {
        if (count($this->getParticipants()) >= 12) {
            throw new \InvalidSchoolingException("Schulung bereits voll - Teilnehmer nicht hinzugefügt!");
        }
        $id = $participant->getId()->getId();
        $this->participants[$id] = $participant;
    }

    public function getParticipants() : array
    {
        return $this->participants;
    }

    public function getParticipantsGrade(ID $id) : string
    {
        if (!array_key_exists($id->getId(), $this->participants)) {
            throw new \InvalidSchoolingException("Kein Teilnehmer $id vorhanden!");
        }
        $id = $id->getId();
        return $this->participants[$id]->getGrade();
    }

    public function printParticipants()
    {
        foreach ($this->participants as $participant) {
            printf("Teilnehmer: %s Note: %s", $participant->getName(), $participant->getGrade());
        }
    }
}

