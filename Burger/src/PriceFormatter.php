<?php


class PriceFormatter
{
    /**
     * @param int $price
     * @param string $separator
     * @return string
     */
    public function formatPrice($price, $separator = '')
    {
        return number_format($price / 100, 2, '.', $separator);
    }
}