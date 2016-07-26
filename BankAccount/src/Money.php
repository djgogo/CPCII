<?php
declare(strict_types = 1);

class Money
{
    /**
     * @var float
     */
    private $amount;

    /**
     * @var Currency
     */
    private $currency;

    public function __construct(float $amount, Currency $currency)
    {
        if (!is_float($amount)) {
            throw new InvalidMoneyException("$amount must be a floating number");
        }

        $this->amount = $amount;
        $this->currency = $currency;
    }

    public function getAmount() : float
    {
        return $this->amount;
    }

    public function getCurrency() : Currency
    {
        return $this->currency;
    }

    public function add(Money $other) : Money
    {
        $this->ensureSameCurrency($this, $other);
        $value = $this->amount + $other->getAmount();
        $this->ensureIsFloat($value);
        return new self($value, $this->currency);
    }

    public function subtract(Money $other) : Money
    {
        $this->ensureSameCurrency($this, $other);
        $value = $this->amount - $other->getAmount();
        $this->ensureIsFloat($value);
        return new self($value, $this->currency);
    }

    private function ensureSameCurrency(Money $a, Money $b)
    {
        if ($a->getCurrency() != $b->getCurrency()) {
            throw new InvalidMoneyException("$a is not matching $b");
        }
    }

    private function ensureIsFloat($amount)
    {
        if (!is_float($amount)) {
            throw new InvalidMoneyException("$amount is not a floating number");
        }
    }
}
