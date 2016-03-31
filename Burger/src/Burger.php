<?php


class Burger
{
    /**
     * @var IngredientCollection
     */
    private $ingredientCollection;

    /**
     * @param IngredientCollection $ingredientCollection
     */
    public function __construct(IngredientCollection $ingredientCollection)
    {
        $this->ingredientCollection = $ingredientCollection;
    }

    /**
     * @return Price
     */
    public function getPrice()
    {
        $first = true;

        $totalPrice = null;

        foreach ($this->ingredientCollection as $ingredient) {
            if ($first) {
                $totalPrice = $ingredient->getPrice();
                $first = false;
                continue;
            }

            $totalPrice = $totalPrice->add($ingredient->getPrice());
        }

        return $totalPrice;
    }
}