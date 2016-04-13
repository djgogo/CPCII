<?php


class Student
{
    /**
     * @var EnrollmentNumber
     */
    private $enrollmentNumber;
    /**
     * @var string
     */
    private $name;
    /**
     * @var Course
     */
    private $course;
    /**
     * @var bool
     */
    private $enrolStatus = false;

    /**
     * @param EnrollmentNumber $enrollmentNumber
     */
    public function __construct(EnrollmentNumber $enrollmentNumber, string $name)
    {
        $this->enrollmentNumber = $enrollmentNumber;
        $this->name = $name;
    }

    /**
     * @return EnrollmentNumber
     */
    public function getEnrollmentNumber() : EnrollmentNumber
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
    public function setCourse(Course $course)
    {
        if ($this->isEnrolled()){
            throw new RuntimeException('Student has already enrolled in a course - enrolling in a new one is not possible');
        }
        $this->course = $course;
    }

    /**
     * @return bool
     */
    public function isEnrolled() : bool
    {
        if ($this->course === null) {
            return false;
        }
        return true;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (string)$this->enrollmentNumber;
    }
}