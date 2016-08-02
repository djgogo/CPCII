<?php
declare(strict_types = 1);

namespace Cart
{
    use Cart\Exceptions\PresentationException;

    class EuroFormatter
    {
        private $currencies = [
            Money::CURRENCY_EUR => 'EUR',
        ];

        public function format(Money $money) : string
        {
            $this->ensureCurrencyIsSupported($money->getCurrency());
            return $this->formatAmount($money) . ' ' . $this->formatCurrency($money);
        }

        public function formatAmount(Money $money) : string
        {
            $this->ensureCurrencyIsSupported($money->getCurrency());
            return number_format($money->getAmount() / 100, 2);
        }

        public function formatCurrency(Money $money) : string
        {
            $this->ensureCurrencyIsSupported($money->getCurrency());
            return $this->currencies[$money->getCurrency()];
        }

        private function ensureCurrencyIsSupported(string $currency)
        {
            if ($currency != Money::CURRENCY_EUR) {
                throw new PresentationException('Invalid Currency');
            }
        }
    }
}
