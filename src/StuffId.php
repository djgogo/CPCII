<?php


class StuffId
{
    /**
     * @var int
     */
    private $stuffId;

    /**
     * @param int $stuffId
     */
    public function __construct($stuffId)
    {
        $this->ensureEnrollmentNumberIsInteger($stuffId);
        $this->ensureEnrollmentNumberIsBiggerThanZero($stuffId);

        $this->stuffId = $stuffId;
    }

    /**
     * @param $stuffId
     */
    private function ensureEnrollmentNumberIsInteger($stuffId)
    {
        if (!is_integer($stuffId)) {
            throw new \InvalidArgumentException('Stuff Id was not integer: ' . $stuffId);
        }
    }

    /**
     * @param int $stuffId
     */
    private function ensureEnrollmentNumberIsBiggerThanZero($stuffId)
    {
        if ($stuffId < 0) {
            throw new \InvalidArgumentException('Stuff Id was lower than zero: ' . $stuffId);
        }
    }
}