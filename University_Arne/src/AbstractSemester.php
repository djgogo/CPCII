<?php
declare(strict_types = 1);

abstract class AbstractSemester implements Semester
{
    /**
     * @var Course[]
     */
    private $courses = [];

    public function getCourses() : array
    {
        if (empty($this->courses)) {
            $this->courses = $this->createCourses();
        }

        return $this->courses;
    }

    /**
     * @param string $courseName
     * @return Course
     */
    public function getCourse(string $courseName) : Course
    {
        foreach ($this->getCourses() as $course) {
            if ($courseName == $course->getName()) {
                return $course;
            }
        }
        throw new RuntimeException(sprintf('There is no Course "%s" on our List.', $courseName));
    }

    abstract protected function createCourses() : array;
}
