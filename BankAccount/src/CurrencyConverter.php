<?php
declare(strict_types = 1);

class CurrencyConverter
{
    /**
     * @var EzbCurrencyXmlParser
     */
    private $currencyRates = [];

    public function __construct(EzbCurrencyXmlParser $parser)
    {
        //$this->currencyRates = json_decode(json_encode((array)$parser), TRUE);
        $this->currencyRates = (array) $parser;
    }

    public function convert(string $from, string $to, float $amount)
    {
        $from = strtoupper($from);
        $to = strtoupper($to);

        if ($from === $to) {
            return $amount;
        }

        $this->ensureCurrencyExists($from);
        $this->ensureCurrencyExists($to);

        if ($from == 'EUR') {
            return round($this->currencyRates[$to] * $amount, 2);
        }

        if ($to == 'EUR') {
            return round($amount / $this->currencyRates[$from], 2);
        }

        $amountEur = $this->convert($from, 'EUR', $amount);

        return $this->convert('EUR', $to, $amountEur);
    }

    private function ensureCurrencyExists(string $currency)
    {
        if ($currency !== 'EUR' && !isset($this->currencyRates[$currency])) {
            throw new \InvalidArgumentException("Unrecognised currency $currency, available currencies: ");
                //. implode(',',$this->currencyRates->getAvailableCurrencies()));
        }
    }
}
