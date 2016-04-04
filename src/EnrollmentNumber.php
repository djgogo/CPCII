<?php


class EnrollmentNumber
{
    /**
     * @var int
     */
    private $enrollmentNumber;

    /**
     * @param int $enrollmentNumber
     */
    public function __construct($enrollmentNumber)
    {
        $this->ensureEnrollmentNumberIsInteger($enrollmentNumber);
        $this->ensureEnrollmentNumberIsBiggerThanZero($enrollmentNumber);

        $this->enrollmentNumber = $enrollmentNumber;
    }

    /**
     * @param $enrollmentNumber
     */
    private function ensureEnrollmentNumberIsInteger($enrollmentNumber)
    {
        if (!is_integer($enrollmentNumber)) {
            throw new \InvalidArgumentException('Enrollment Number was not integer: ' . $enrollmentNumber);
        }
    }

    /**
     * @param int $enrollmentNumber
     */
    private function ensureEnrollmentNumberIsBiggerThanZero($enrollmentNumber)
    {
        if ($enrollmentNumber < 0) {
            throw new \InvalidArgumentException('Enrollment Number was lower than zero: ' . $enrollmentNumber);
        }
    }
}