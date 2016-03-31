<?php


class Price
{
    /**
     * @var int
     */
    private $price;

    /**
     * @param int $price
     */
    public function __construct($price)
    {
        $this->setPrice($price);
    }

    /**
     * @param int $price
     */
    private function setPrice($price)
    {
        if (!is_integer($price) || $price < 0) {
            throw new \InvalidArgumentException('invalid price "' . $price . '"');
        }

        $this->price = (int) $price;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (string) $this->price;
    }
}