<?php
declare(strict_types = 1);

interface Semester
{
    /**
     * @return array
     */
    public function getCourses() : array;

    /**
     * @return string
     */
    public function getName() : string;

    /**
     * @param string $courseName
     * @return Course
     */
    public function getCourse(string $courseName) : Course;
}