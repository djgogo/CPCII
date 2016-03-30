<?php

class BurgerFactory
{
    /**
     * @param Recipe $recipe
     * @return Burger
     */
    public function createBurger(Recipe $recipe)
    {
        $burger = new Burger();
        foreach ($recipe as $ingredient) {
            $burger->addIngredient($ingredient);
        }

        return $burger;
    }
}