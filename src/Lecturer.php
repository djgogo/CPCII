<?php


class Lecturer
{
    /**
     * @var StaffId
     */
    private $staffId;

    /**
     * Lecturer constructor.
     * @param StaffId $staffId
     */
    public function __construct(StaffId $staffId)
    {
        $this->staffId = $staffId;
    }

    /**
     * @return StaffId
     */
    public function getStaffId() : StaffId
    {
        return $this->staffId;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (string)$this->staffId;
    }
}