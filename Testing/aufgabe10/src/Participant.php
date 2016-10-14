<?php
declare(strict_types = 1);

class Participant
{
    /**
     * @var Id
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $grade;

    public function __construct(string $name, Counter $counter)
    {
        $this->id = new Id($counter);
        $this->name = $name;
    }

    public function getname() : string
    {
        return $this->name;
    }

    public function getId() : Id
    {
        return $this->id;
    }

    public function addGrade(string $grade)
    {
        $this->grade = $grade;
    }

    public function getGrade() : string
    {
        return $this->grade;
    }
}

