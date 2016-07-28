<?php
declare(strict_types = 1);

namespace BankAccount {

    use BankAccount\Currencies\Currency;
    use BankAccount\Currencies\EUR;

    class CurrencyConverter
    {
        /**
         * @var array
         */
        private $currencyRates = [];

        public function __construct(EcbCurrencyXmlParser $parser)
        {
            $this->currencyRates = $parser->getCurrencies();
        }

        public function convert(Currency $from, Currency $to, float $amount) : Money
        {
            if ($from instanceof EUR) {
                return new Money(round($this->currencyRates[(string) $to] * $amount, 2), $to);
            }

            if ($to instanceof EUR) {
                return new Money(round($amount / $this->currencyRates[(string) $from], 2), $to);
            }

            $amountEuro = $this->convert($from, new EUR, $amount);
            return $this->convert(new EUR, $to, $amountEuro->getAmount());
        }
    }
}
