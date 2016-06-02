<?php
declare(strict_types = 1);

abstract class Course
{
    /**
     * @var Student[]
     */
    private $students;

    /**
     * @return string
     */
    abstract public function getName() : string;

    /**
     * @param Student $student
     */
    public function enrolStudent(Student $student)
    {
        $this->students[] = $student;
        $student->enrolToCourse($this);
    }

    /**
     * @return Student[]
     */
    public function getEnrolledStudents() : array
    {
        return $this->students;
    }
}