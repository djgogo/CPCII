<?php


class IngredientFactory
{
    /**
     * @param Price $price
     * @return Cheese
     */
    public function createCheese(Price $price) : Cheese
    {
        return new Cheese($price);
    }

    /**
     * @param Price $price
     * @return Salad
     */
    public function createSalad(Price $price) : Salad
    {
        return new Salad($price);
    }

    /**
     * @param Price $price
     * @return Tomato
     */
    public function createTomato(Price $price) : Tomato
    {
        return new Tomato($price);
    }

    /**
     * @param Price $price
     * @return LowerBread
     */
    public function createLowerBread(Price $price) : LowerBread
    {
        return new LowerBread($price);
    }

    /**
     * @param Price $price
     * @return UpperBread
     */
    public function createUpperBread(Price $price) : UpperBread
    {
        return new UpperBread($price);
    }

    /**
     * @param Price $price
     * @return Patty
     */
    public function createPatty(Price $price) : Patty
    {
        return new Patty($price);
    }

    /**
     * @param Price $price
     * @return Sauce
     */
    public function createSauce(Price $price) : Sauce
    {
        return new Sauce($price);
    }

}