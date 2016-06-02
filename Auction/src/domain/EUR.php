<?php
class EUR
{
    private $cents;

    public function __construct(int $cents)
    {
        $this->cents = $cents;
    }

    public function getCents() : int
    {
        return $this->cents;
    }

    public function lessThan(EUR $other) : bool
    {
        return $this->cents < $other->getCents();
    }

    public function plus(EUR $other) : EUR
    {
        return new self($this->cents + $other->getCents());
    }
}
