<?php
declare(strict_types = 1);

namespace BankAccount
{

    use BankAccount\Currencies\Currency;
    use BankAccount\Currencies\EUR;
    use BankAccount\Currencies\USD;
    use BankAccount\Exceptions\PresentationException;

    class AmountFormatter
    {
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
            return $money->getCurrency()->getSign();
        }

        private function ensureCurrencyIsSupported(Currency $currency)
        {
            if (!$currency instanceof EUR && !$currency instanceof USD) {
                throw new PresentationException('Invalid Currency');
            }
        }
    }
}
