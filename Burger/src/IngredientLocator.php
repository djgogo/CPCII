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
                return $this->ingredientRepository->getIngredient(Cheese::class);
            case 'Salad':
                return $this->ingredientRepository->getIngredient(Salad::class);
            case 'Tomato':
                return $this->ingredientRepository->getIngredient(Tomato::class);
            case 'LowerBread':
                return $this->ingredientRepository->getIngredient(LowerBread::class);
            case 'UpperBread':
                return $this->ingredientRepository->getIngredient(UpperBread::class);
            case 'Patty':
                return $this->ingredientRepository->getIngredient(Patty::class);
            case 'Sauce':
                return $this->ingredientRepository->getIngredient(Sauce::class);
            default:
                throw new InvalidArgumentException('Unknown ingredient type');
        }
    }
}