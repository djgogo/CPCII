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

        public function convert(Currency $from, Currency $to, int $amount) : Money
        {
            if ($from instanceof EUR) {
                return new Money((int) round($this->currencyRates[(string) $to] * $amount, 0), $to);
            }

            if ($to instanceof EUR) {
                return new Money((int) round($amount / $this->currencyRates[(string) $from], 0), $to);
            }

            $amountEuro = $this->convert($from, new EUR, $amount);
            return $this->convert(new EUR, $to, $amountEuro->getAmount());
        }
    }
}
