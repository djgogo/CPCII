<?php


class ModuleNumber
{
    /**
     * @var int
     */
    private $moduleNumber;

    public function __construct(int $moduleNumber)
    {
        $this->ensureModuleNumberIsBiggerThanZero($moduleNumber);
        $this->ensureStuffIdHasTheRightLength($moduleNumber);

        $this->moduleNumber = $moduleNumber;
    }

    /**
     * @param $moduleNumber
     */
    private function ensureModuleNumberIsBiggerThanZero($moduleNumber)
    {
        if ($moduleNumber < 0) {
            throw new \InvalidArgumentException('Module Number was lower than zero: ' . $moduleNumber);
        }
    }

    /**
     * @param $moduleNumber
     */
    public function ensureStuffIdHasTheRightLength($moduleNumber)
    {
        if ($moduleNumber > 999) {
            throw new \InvalidArgumentException('Module Number was bigger than 3 Characters ' . $moduleNumber);
        }
    }

    public function __toString()
    {
        return (string)$this->moduleNumber;
    }
}