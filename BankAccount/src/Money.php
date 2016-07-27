<?php
declare(strict_types = 1);

class Money
{
    /**
     * @var int
     */
    private $amount;

    /**
     * @var Currency
     */
    private $currency;

    public function __construct(int $amount, Currency $currency)
    {
        if (!is_int($amount)) {
            throw new InvalidMoneyException("$amount must be an integer");
        }

        $this->amount = $amount;
        $this->currency = $currency;
    }

    public function getAmount() : float
    {
        return round($this->amount / $this->currency->getSubUnit(), $this->currency->getDefaultFractionDigits());
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
        if (!is_int($amount)) {
            throw new InvalidMoneyException("$amount is not an integer");
        }
    }
}
