<?php


class Burger
{
    /**
     * @var Ingredient[]
     */
    private $ingredients;

    /**
     * @param array $ingredients
     */
    public function __construct(array $ingredients)
    {
        $this->ingredients = $ingredients;
    }

    /**
     * @return Ingredient[]
     */
    public function getIngredients() : array
    {
        return $this->ingredients;
    }

    /**
     * @return Price
     */
    public function getPrice()
    {
        $totalPrice = 0;

        foreach ($this->ingredients as $ingredient) {
            $totalPrice += (int) ((string) $ingredient->getPrice());
        }

        return new Price($totalPrice);
    }
}