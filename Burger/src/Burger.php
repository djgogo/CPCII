<?php

class Burger
{
    /**
     * @var Ingredient[]
     */
    private $ingredients;
    /**
     * @var string
     */
    private $name;

    /**
     * @param string $name
     * @param Ingredient[] $ingredients
     */
    public function __construct(string $name, Ingredient ...$ingredients)
    {
        $this->ingredients = $ingredients;
        $this->name = $name;
    }

    /**
     * @param Currency $currency
     * @return Price
     */
    public function getPrice(Currency $currency)
    {
        $totalPrice = new Price(new Amount(0), $currency);

        foreach ($this->ingredients as $ingredient) {
            $totalPrice = $totalPrice->add($ingredient->getPrice());
        }

        return $totalPrice;
    }

    public function getName()
    {
        return $this->name;
    }
}