<?php

class BurgerBuilder
{
    /**
     * @var IngredientRepository
     */
    private $ingredientRepository;

    /**
     * @var CollectionFactory
     */
    private $collectionFactory;

    /**
     * BurgerBuilder constructor.
     * @param IngredientRepository $ingredientRepository
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(IngredientRepository $ingredientRepository, CollectionFactory $collectionFactory)
    {
        $this->ingredientRepository = $ingredientRepository;
        $this->collectionFactory    = $collectionFactory;
    }

    /**
     * @param Recipe $recipe
     * @return Burger
     */
    public function build(Recipe $recipe)
    {
        $ingredientNameCollection = $recipe->getIngredientNameCollection();

        if (!$ingredientNameCollection->hasIngredients()) {
            throw new RuntimeException('No ingredients in collection, cannot build a burger');
        }

        $ingredientCollection = $this->collectionFactory->createIngredientCollection();

        foreach ($ingredientNameCollection as $ingredient) {
            $ingredientCollection->add($this->ingredientRepository->getIngredient($ingredient));
        }

        return new Burger($ingredientCollection);
    }
}