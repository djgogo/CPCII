<?php

class Price
{
    /**
     * @var Amount
     */
    private $amount;

    /**
     * @var Currency
     */
    private $currency;

    /**
     * @param Amount $amount
     * @param Currency $currency
     */
    public function __construct(Amount $amount, Currency $currency)
    {
        $this->amount = $amount;
        $this->currency = $currency;
    }

    /**
     * @param Price $price
     * @return Price
     */
    public function add(Price $price)
    {
        if (!$this->currency->equals($price->getCurrency())) {
            return new InvalidArgumentException('Can not add price of different currency');
        }

        return new static($this->amount->add($price->getAmount()), $this->currency);
    }

    /**
     * @return Amount
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @return Currency
     */
    public function getCurrency()
    {
        return $this->currency;
    }
}
