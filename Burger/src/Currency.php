<?php

class Currency
{
    /**
     * @var string
     */
    private $sign;

    /**
     * @param $sign
     */
    public function __construct($sign)
    {
        $this->sign = $sign;
    }

    /**
     * @return string
     */
    public function getSign()
    {
        return $this->sign;
    }

    /**
     * @param Currency $currency
     * @return bool
     */
    public function equals(Currency $currency) : bool
    {
        return $this->sign === $currency->getSign();
    }
}