<?php
declare(strict_types = 1);

namespace BankAccount
{
    use BankAccount\Currencies\Currency;
    use BankAccount\Exceptions\InvalidMoneyException;

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
                throw new InvalidMoneyException($amount . 'must be a floating number');
            }

            $this->amount = $amount;
            $this->currency = $currency;
        }

        public function getAmount() : float
        {
            // if the money-object will be consequently in integer format! the following would be getFormattedAmount()
            // return round($this->amount / $this->currency->getSubUnit(), $this->currency->getDefaultFractionDigits());
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
                throw new InvalidMoneyException($a->getCurrency() . 'is not matching' . $b->getCurrency());
            }
        }

        private function ensureIsFloat($amount)
        {
            if (!is_float($amount)) {
                throw new InvalidMoneyException($amount . 'must be a floating number');
            }
        }
    }
}
