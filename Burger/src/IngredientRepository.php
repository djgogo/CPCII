<?php

class IngredientRepository
{
    /**
     * @var array
     */
    private $ingredients;

    /**
     * @param Cheese $cheese
     */
    public function addCheese(Cheese $cheese)
    {
        $this->ingredients[] = $cheese;
    }

    /**
     * @return Cheese
     */
    public function getCheese()
    {
        return $this->getIngredient(Cheese::class);
    }

    /**
     * @param Salad $salad
     */
    public function addSalad(Salad $salad)
    {
        $this->ingredients[] = $salad;
    }

    /**
     * @return Salad
     */
    public function getSalad()
    {
        return $this->getIngredient(Salad::class);
    }

    /**
     * @param Tomato $tomato
     */
    public function addTomato(Tomato $tomato)
    {
        $this->ingredients[] = $tomato;
    }

    /**
     * @return Tomato
     */
    public function getTomato()
    {
        return $this->getIngredient(Tomato::class);
    }

    /**
     * @param LowerBread $lowerBread
     */
    public function addLowerBread(LowerBread $lowerBread)
    {
        $this->ingredients[] = $lowerBread;
    }

    /**
     * @return LowerBread
     */
    public function getLowerBread()
    {
        return $this->getIngredient(LowerBread::class);
    }

    /**
     * @param UpperBread $upperBread
     */
    public function addUpperBread(UpperBread $upperBread)
    {
        $this->ingredients[] = $upperBread;
    }

    /**
     * @return UpperBread
     */
    public function getUpperBread()
    {
        return $this->getIngredient(UpperBread::class);
    }

    /**
     * @param Patty $patty
     */
    public function addPatty(Patty $patty)
    {
        $this->ingredients[] = $patty;
    }

    /**
     * @return Patty
     */
    public function getPatty()
    {
        return $this->getIngredient(Patty::class);
    }

    /**
     * @param Sauce $sauce
     */
    public function addSauce(Sauce $sauce)
    {
        $this->ingredients[] = $sauce;
    }

    /**
     * @return Sauce
     */
    public function getSauce()
    {
        return $this->getIngredient(Sauce::Class);
    }

    /**
     * @param string $ingredientClassName
     */
    private function getIngredient($ingredientClassName)
    {
        foreach ($this->ingredients as $key => $ingredient) {
            if ($ingredient instanceof $ingredientClassName) {
                unset($this->ingredients[$key]);
                return $ingredient;
            }
        }

        throw new RuntimeException(sprintf('No more ingredients of type "%s" available.', $ingredientClassName));
    }
}