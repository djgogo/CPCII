<?php
declare(strict_types = 1);

namespace BankAccount
{
    use BankAccount\Currencies\Currency;
    use BankAccount\Exceptions\InvalidMoneyException;

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
                throw new InvalidMoneyException($amount . 'must be an integer');
            }

            $this->amount = $amount;
            $this->currency = $currency;
        }

        public function getAmount() : int
        {
            return $this->amount;
        }

        public function getFormattedAmount() : float
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
            $this->ensureIsInt($value);
            return new self($value, $this->currency);
        }

        public function subtract(Money $other) : Money
        {
            $this->ensureSameCurrency($this, $other);
            $value = $this->amount - $other->getAmount();
            $this->ensureIsInt($value);
            return new self($value, $this->currency);
        }

        private function ensureSameCurrency(Money $a, Money $b)
        {
            if ($a->getCurrency() != $b->getCurrency()) {
                throw new InvalidMoneyException($a->getCurrency() . 'is not matching' . $b->getCurrency());
            }
        }

        private function ensureIsInt($amount)
        {
            if (!is_int($amount)) {
                throw new InvalidMoneyException($amount . 'must be an integer');
            }
        }
    }
}
