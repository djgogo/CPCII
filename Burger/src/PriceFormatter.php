<?php


class PriceFormatter
{
    /**
     * @param int $price
     * @return string
     */
    public function format($price)
    {
        return $this->formatPrice($price, '\'');
    }

    /**
     * @param int $price
     * @param string $separator
     * @return string
     */
    private function formatPrice($price, $separator = '')
    {
        return number_format($price / 100, 2, '.', $separator);
    }
}