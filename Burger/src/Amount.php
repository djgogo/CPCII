<?php


class Amount
{
    /**
     * @var int
     */
    private $amount;

    /**
     * @param int $amount
     */
    public function __construct($amount)
    {
        $this->ensureAmountIsInteger($amount);
        $this->ensureAmountBiggerThanZero($amount);

        $this->amount = $amount;
    }

    /**
     * @param $amount
     */
    private function ensureAmountIsInteger($amount)
    {
        if (!is_integer($amount)) {
            throw new \InvalidArgumentException('Amount was not integer: ' . $amount);
        }
    }

    /**
     * @param int $amount
     */
    private function ensureAmountBiggerThanZero($amount)
    {
        if ($amount < 0) {
            throw new \InvalidArgumentException('Amount was lower than zero: ' . $amount);
        }
    }

    /**
     * @param Amount $amount-
     * @return Amount
     */
    public function add(Amount $amount)
    {
        return new static($this->amount + $amount->getAmountValue());
    }

    /**
     * @return int
     */
    public function getAmountValue() : int
    {
        return $this->amount;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (string) $this->amount;
    }
}