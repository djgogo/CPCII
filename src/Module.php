<?php


abstract class Module
{
    /**
     * @var
     */
    private $course;
    /**
     * @var Lecturer
     */
    private $lecturer;

    public function __construct(Lecturer $lecturer)
    {
        $this->lecturer = $lecturer;
    }

    /**
     * @return string
     */
    abstract public function getName() : string;
    abstract public function getModuleNumber() : int;

    /**
     * @param Course $course
     */
    public function setCourse(Course $course)
    {
        $this->course = $course;
    }

    /**
     * @param Lecturer $lecturer
     */
    public function setLecturer(Lecturer $lecturer)
    {
        $this->lecturer = $lecturer;
    }

    public function getLecturer() : Lecturer
    {
        return $this->lecturer;
    }
}