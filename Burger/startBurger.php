<?php
require_once 'autoload.php';

$burgerFactory = new BurgerFactory();

$hamburger = $burgerFactory->createBurger(new HamburgerRecipe());
$cheeseburger = $burgerFactory->createBurger(new CheeseburgerRecipe());

var_dump($hamburger);
var_dump($cheeseburger);
