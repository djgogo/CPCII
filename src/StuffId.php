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
        $this->ensureStuffIdIsInteger($stuffId);
        $this->ensureStuffIdNumberIsBiggerThanZero($stuffId);
        $this->ensureStuffIdHasTheRightLength($stuffId);

        $this->stuffId = $stuffId;
    }

    /**
     * @param $stuffId
     */
    private function ensureStuffIdIsInteger($stuffId)
    {
        if (!is_integer($stuffId)) {
            throw new \InvalidArgumentException('Stuff Id was not integer: ' . $stuffId);
        }
    }

    /**
     * @param int $stuffId
     */
    private function ensureStuffIdNumberIsBiggerThanZero($stuffId)
    {
        if ($stuffId < 0) {
            throw new \InvalidArgumentException('Stuff Id was lower than zero: ' . $stuffId);
        }
    }

    /**
     * @param $stuffId
     */
    public function ensureStuffIdHasTheRightLength($stuffId)
    {
        if ($stuffId > 99999) {
            throw new \InvalidArgumentException('Stuff Id was bigger than 5 Characters ' . $stuffId);
        }
    }

    public function __toString()
    {
        return (string)$this->stuffId;
    }
}