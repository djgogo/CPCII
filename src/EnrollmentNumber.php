<?php


class EnrollmentNumber
{
    /**
     * @var string
     */
    private $enrollmentNumber;

    /**
     * @param string $enrollmentNumber
     */
    public function __construct($enrollmentNumber = null)
    {
        if ($enrollmentNumber !== null) {
            $this->enrollmentNumber = $enrollmentNumber;
        } else {
            $this->setUniqueEnrollmentNumberValue();
        }
    }

    private function setUniqueEnrollmentNumberValue()
    {
        $source = uniqid(mt_rand(0, PHP_INT_MAX), true);
        $this->enrollmentNumber = sha1(hash('sha512', $source, true));
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->enrollmentNumber;
    }
}