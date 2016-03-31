<?php
require_once 'autoload.php';

$ingredientFactory = new IngredientFactory();
$ingredientRepository = new IngredientRepository();
$ingredientLocator = new IngredientLocator($ingredientRepository);

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

$burgerBuilder = new BurgerBuilder($ingredientLocator);

$hamburger = $burgerBuilder->build(new HamburgerRecipe());
$cheeseburger = $burgerBuilder->build(new CheeseburgerRecipe());

var_dump($hamburger);
var_dump($cheeseburger);
