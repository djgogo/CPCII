<?php
require_once 'autoload.php';

$ingredientFactory = new IngredientFactory();

$ingredientRepository = new IngredientRepository();

$ingredientRepository->addSalad($ingredientFactory->createSalad());
$ingredientRepository->addSalad($ingredientFactory->createSalad());
$ingredientRepository->addSauce($ingredientFactory->createSauce());
$ingredientRepository->addSauce($ingredientFactory->createSauce());
$ingredientRepository->addLowerBread($ingredientFactory->createLowerBread());
$ingredientRepository->addLowerBread($ingredientFactory->createLowerBread());
$ingredientRepository->addUpperBread($ingredientFactory->createUpperBread());
$ingredientRepository->addUpperBread($ingredientFactory->createUpperBread());
$ingredientRepository->addTomato($ingredientFactory->createTomato());
$ingredientRepository->addTomato($ingredientFactory->createTomato());
$ingredientRepository->addPatty($ingredientFactory->createPatty());
$ingredientRepository->addPatty($ingredientFactory->createPatty());
$ingredientRepository->addCheese($ingredientFactory->createCheese());

$burgerFactory = new BurgerBuilder();

$hamburger = $burgerFactory->build(new HamburgerRecipe());
$cheeseburger = $burgerFactory->build(new CheeseburgerRecipe());

var_dump($hamburger);
var_dump($cheeseburger);
