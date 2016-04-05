<?php


class Student
{
    /**
     * @var EnrollmentNumber
     */
    private $enrollmentNumber;

    /**
     * @param EnrollmentNumber $enrollmentNumber
     */
    public function __construct(EnrollmentNumber $enrollmentNumber)
    {
        $this->enrollmentNumber = $enrollmentNumber;
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
    public function __toString()
    {
        return (string)$this->enrollmentNumber;
    }
}