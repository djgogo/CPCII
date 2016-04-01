<?php

class Burger
{
    /**
     * @var Ingredient[]
     */
    private $ingredients;

    /**
     * @param Ingredient[] $ingredients
     */
    public function __construct(Ingredient ...$ingredients)
    {
        $this->ingredients = $ingredients;
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
}