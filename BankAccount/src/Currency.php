<?php
declare(strict_types = 1);

class Currency
{
    /**
     * @var array
     */
    private static $currencies = [
        'CHF' => [
            'displayName' => 'Swiss Franc',
            'sign' => 'Fr.',
            'defaultFractionDigits' => 2,
            'subUnit' => 100,
        ],
        'EUR' => [
            'displayName' => 'Euro',
            'sign' => '€',
            'defaultFractionDigits' => 2,
            'subUnit' => 100,
        ],
        'USD' => [
            'displayName' => 'US Dollar',
            'sign' => '$',
            'defaultFractionDigits' => 2,
            'subUnit' => 100,
        ]
    ];

    /**
     * @var string
     */
    private $currencyCode;

    public function __construct(string $currencyCode)
    {
        if (!isset(self::$currencies[$currencyCode])) {
            $currencyCode = strtoupper($currencyCode);
        }

        if (!isset(self::$currencies[$currencyCode])) {
            throw new InvalidArgumentException(sprintf('Unknown currency code "%s"', $currencyCode));
        }

        $this->currencyCode = $currencyCode;
    }

    public static function addCurrency(
        string $code,
        string $displayName,
        string $sign,
        int $defaultFractionDigits,
        int $subUnit)
    {
        self::$currencies[$code] = [
            'displayName' => $displayName,
            'sign' => $sign,
            'defaultFractionDigits' => $defaultFractionDigits,
            'sub_unit' => $subUnit,
        ];
    }

    public function getCurrencies() : array
    {
        return self::$currencies;
    }

    public function getCurrencyCode() : string
    {
        return $this->currencyCode;
    }

    public function getDefaultFractionDigits() : int
    {
        return self::$currencies[$this->currencyCode]['defaultFractionDigits'];
    }

    public function getDisplayName() : string
    {
        return self::$currencies[$this->currencyCode]['displayName'];
    }

    public function getSign() : string
    {
        return self::$currencies[$this->currencyCode]['sign'];
    }

    public function getSubUnit() : int
    {
        return self::$currencies[$this->currencyCode]['subUnit'];
    }

    public function __toString() : string
    {
        return $this->currencyCode;
    }

}
