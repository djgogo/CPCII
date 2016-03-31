<?php


class CollectionFactory
{
    /**
     * @return IngredientCollection
     */
    public function createIngredientCollection() : IngredientCollection
    {
        return new IngredientCollection;
    }

    /**
     * @return IngredientNameCollection
     */
    public function createIngredientNameCollection() : IngredientNameCollection
    {
        return new IngredientNameCollection;
    }
}