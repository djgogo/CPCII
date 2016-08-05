<?php
declare(strict_types = 1);

namespace Cart
{
    use Cart\Exceptions\MoneyException;

    class Money
    {
        const CURRENCY_EUR = 'EUR';

        /**
         * @var int
         */
        private $amount;

        /**
         * @var string
         */
        private $currency;

        public function __construct(int $amount, string $currency)
        {
            $this->amount = $amount;
            $this->ensureIsValidCurrency($currency);
            $this->currency = $currency;
        }

        public function getAmount() : int
        {
            return $this->amount;
        }

        public function getCurrency() : string
        {
            return $this->currency;
        }

        public function addTo(Money $money)
        {
            if ($this->getCurrency() != $money->getCurrency()) {
                throw new MoneyException('Currency mismatch');
            }

            return new Money(
                $this->getAmount() + $money->getAmount(),
                $this->getCurrency()
            );
        }

        public function multiplyWith(int $factor)
        {
            return new Money(
                $this->getAmount() * $factor,
                $this->getCurrency()
            );
        }

        private function ensureIsValidCurrency(string $currency)
        {
            if ($currency != self::CURRENCY_EUR) {
                throw new MoneyException('Invalid Currency');
            }
        }
    }
}
