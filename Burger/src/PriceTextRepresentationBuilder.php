<?php


class PriceTextRepresentationBuilder
{
    /**
     * @var PriceFormatter
     */
    private $priceFormatter;

    public function __construct(PriceFormatter $priceFormatter)
    {
        $this->priceFormatter = $priceFormatter;
    }

    /**
     * @param $price
     * @return string
     */
    public function build(Price $price) : string
    {
        return sprintf("%s %s", $this->priceFormatter->formatPrice($price->getAmount()->getAmountValue()), $price->getCurrency()->getSign());
    }
}