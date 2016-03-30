<?php


class IngredientFactory
{
    public function createCheese()
    {
        return new Cheese;
    }

    public function createSalad()
    {
        return new Salad();
    }

    public function createTomato()
    {
        return new Tomato();
    }

    public function createLowerBread()
    {
        return new LowerBread();
    }

    public function createUpperBread()
    {
        return new UpperBread();
    }

    public function createPatty()
    {
        return new Patty();
    }

    public function createSauce()
    {
        return new Sauce();
    }

}