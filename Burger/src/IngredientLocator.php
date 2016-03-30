<?php

class IngredientLocator
{
    /**
     * @var IngredientRepository
     */
    private $ingredientRepository;

    /**
     * @param IngredientRepository $ingredientRepository
     */
    public function __construct(IngredientRepository $ingredientRepository)
    {
        $this->ingredientRepository = $ingredientRepository;
    }

    /**
     * @param string $name
     * @return Ingredient
     */
    public function getIngredient($name)
    {
        switch ($name) {
            case 'Cheese':
                return $this->ingredientRepository->getCheese();
            case 'Salad':
                return $this->ingredientRepository->getSalad();
            case 'Tomato':
                return $this->ingredientRepository->getTomato();
            case 'LowerBread':
                return $this->ingredientRepository->getLowerBread();
            case 'UpperBread':
                return $this->ingredientRepository->getUpperBread();
            case 'Patty':
                return $this->ingredientRepository->getPatty();
            case 'Sauce':
                return $this->ingredientRepository->getSauce();
            default:
                throw new \InvalidArgumentException('Unknown ingredient type');
        }
    }
}