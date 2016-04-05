<?php


class Lecturer
{
    /**
     * @var StuffId
     */
    private $staffId;

    /**
     * Lecturer constructor.
     * @param StuffId $stuffId
     */
    public function __construct(StuffId $stuffId)
    {
        $this->staffId = $stuffId;
    }

    /**
     * @return StuffId
     */
    public function getStuffId() : StuffId
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