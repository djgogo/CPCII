<?php


class Lecturer
{
    /**
     * @var StaffId
     */
    private $staffId;
    /**
     * @var string
     */
    private $name;

    /**
     * @param StaffId $staffId
     * @param string $name
     */
    public function __construct(StaffId $staffId, string $name)
    {
        $this->staffId = $staffId;
        $this->name = $name;
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
    public function getName() : string
    {
        return $this->name;
    }
}