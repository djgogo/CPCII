<?php


class StaffId
{
    /**
     * @var int
     */
    private $staffId;

    /**
     * @param int $staffId
     */
    public function __construct($staffId)
    {
        $this->ensureStuffIdIsInteger($staffId);
        $this->ensureStuffIdNumberIsBiggerThanZero($staffId);
        $this->ensureStuffIdHasTheRightLength($staffId);

        $this->staffId = $staffId;
    }

    /**
     * @param $staffId
     */
    private function ensureStuffIdIsInteger($staffId)
    {
        if (!is_integer($staffId)) {
            throw new \InvalidArgumentException('Stuff Id was not integer: ' . $staffId);
        }
    }

    /**
     * @param int $staffId
     */
    private function ensureStuffIdNumberIsBiggerThanZero($staffId)
    {
        if ($staffId < 0) {
            throw new \InvalidArgumentException('Stuff Id was lower than zero: ' . $staffId);
        }
    }

    /**
     * @param $staffId
     */
    public function ensureStuffIdHasTheRightLength($staffId)
    {
        if ($staffId > 99999) {
            throw new \InvalidArgumentException('Stuff Id was bigger than 5 Characters ' . $staffId);
        }
    }

    public function __toString()
    {
        return (string)$this->staffId;
    }
}