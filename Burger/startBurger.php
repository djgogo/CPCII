<?php
require_once 'autoload.php';

$burgerFactory = new BurgerFactory();

$hamburger = $burgerFactory->createBurger(...(new HamburgerRecipe())->getIngredients());
$cheeseburger = $burgerFactory->createBurger(...(new CheeseburgerRecipe())->getIngredients());

var_dump($hamburger);
var_dump($cheeseburger);
