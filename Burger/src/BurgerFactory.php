<?php

class BurgerFactory
{
    /**
     * @param Ingredient[] ...$ingredients
     * @return Burger
     */
    public function createBurger(Ingredient ...$ingredients)
    {
        $burger = new Burger();
        foreach ($ingredients as $ingredient) {
            $burger->addIngredient($ingredient);
        }

        return $burger;
    }
}