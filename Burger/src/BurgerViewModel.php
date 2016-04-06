<?php


class BurgerViewModel
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $price;

    /**
     * @param string $name
     * @param string $price
     */
    public function __construct(string $name, string $price)
    {
        $this->name = $name;
        $this->price = $price;
    }

    /**
     * @return string
     */
    public function getName() : string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getPrice() : string
    {
        return $this->price;
    }
}