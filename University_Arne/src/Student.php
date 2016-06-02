<?php
declare(strict_types = 1);

class Student
{
    /**
     * @var Id
     */
    private $enrollmentNumber;
    /**
     * @var string
     */
    private $name;
    /**
     * @var Course[]
     */
    private $courses;

    /**
     * @param Id $EnrollmentNumber
     * @param string $name
     */
    public function __construct(Id $EnrollmentNumber, string $name)
    {
        $this->enrollmentNumber = $EnrollmentNumber;
        $this->name = $name;
    }

    /**
     * @return Id
     */
    public function getEnrollmentNumber() : Id
    {
        return $this->enrollmentNumber;
    }

    /**
     * @return string
     */
    public function getName() : string
    {
        return $this->name;
    }

    /**
     * @param Course $course
     */
    public function enrolToCourse(Course $course)
    {
        if (!$this->courses == NULL && in_array($course, $this->courses) == true) {
            throw new RuntimeException(sprintf('Student has already enrolled in course: %s.', $course->getName()));
        }
        $this->courses[] = $course;
    }

    /**
     * @return Course[]
     */
    public function getCourses() : array
    {
        return $this->courses;
    }
}