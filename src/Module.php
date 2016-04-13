<?php


abstract class Module
{
    /**
     * @var
     */
    private $course;
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
}