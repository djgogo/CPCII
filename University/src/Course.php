<?php


class Course
{
    /**
     * @var Module[]
     */
    private $modules;
    /**
     * @var Student[]
     */
    private $students;
    /**
     * @var string
     */
    private $name;

    /**
     * @param string $name
     * @param Module[] $modules
     */
    public function __construct(string $name, Module ...$modules)
    {
        foreach ($modules as $module) {
            $module->setCourse($this);
        }
        $this->modules = $modules;
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName() : string
    {
        return $this->name;
    }

    /**
     * @param Student $student
     */
    public function enrolStudent(Student $student)
    {
        $this->students[] = $student;
        $student->setCourse($this);
    }

    /**
     * @return Student[]
     */
    public function getEnrolledStudents() : array
    {
        return $this->students;
    }

    /**
     * @return Module[]
     */
    public function getModules() : array
    {
        return $this->modules;
    }
}