<?php
declare(strict_types = 1);

class StaffId
{
    /**
     * @var int
     */
    private $staffId;

    /**
     * @param int $staffId
     */
    public function __construct(int $staffId)
    {
        $this->ensureStaffIdNumberIsBiggerThanZero($staffId);
        $this->ensureStaffIdHasTheRightLength($staffId);

        $this->staffId = $staffId;
    }

    /**
     * @param $staffId
     */
    private function ensureStaffIdNumberIsBiggerThanZero($staffId)
    {
        if ($staffId < 0) {
            throw new InvalidArgumentException('Staff Id was lower than zero: ' . $staffId);
        }
    }

    /**
     * @param $staffId
     */
    private function ensureStaffIdHasTheRightLength($staffId)
    {
        if ($staffId > 99999) {
            throw new InvalidArgumentException('Staff Id was bigger than 5 Digits ' . $staffId);
        }
    }

    /**
     * @return string
     */
    public function __toString() : string
    {
        return (string)$this->staffId;
    }
}