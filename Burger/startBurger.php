<?php
require_once 'autoload.php';

$ingredientFactory = new IngredientFactory();
$ingredientRepository = new IngredientRepository();

$euro = new Currency('€');

$ingredientRepository->addIngredient($ingredientFactory->createSalad(new Price(new Amount(80), $euro)));
$ingredientRepository->addIngredient($ingredientFactory->createSalad(new Price(new Amount(80), $euro)));
$ingredientRepository->addIngredient($ingredientFactory->createSauce(new Price(new Amount(50), $euro)));
$ingredientRepository->addIngredient($ingredientFactory->createSauce(new Price(new Amount(50), $euro)));
$ingredientRepository->addIngredient($ingredientFactory->createLowerBread(new Price(new Amount(300), $euro)));
$ingredientRepository->addIngredient($ingredientFactory->createLowerBread(new Price(new Amount(300), $euro)));
$ingredientRepository->addIngredient($ingredientFactory->createUpperBread(new Price(new Amount(300), $euro)));
$ingredientRepository->addIngredient($ingredientFactory->createUpperBread(new Price(new Amount(300), $euro)));
$ingredientRepository->addIngredient($ingredientFactory->createTomato(new Price(new Amount(50), $euro)));
$ingredientRepository->addIngredient($ingredientFactory->createTomato(new Price(new Amount(50), $euro)));
$ingredientRepository->addIngredient($ingredientFactory->createPatty(new Price(new Amount(500), $euro)));
$ingredientRepository->addIngredient($ingredientFactory->createPatty(new Price(new Amount(500), $euro)));
$ingredientRepository->addIngredient($ingredientFactory->createCheese(new Price(new Amount(100), $euro)));

$burgerBuilder = new BurgerBuilder($ingredientRepository);
$priceTextRepresentationBuilder = new PriceTextRepresentationBuilder(new PriceFormatter());

$hamburger = $burgerBuilder->build(new HamburgerRecipe);
$cheeseburger = $burgerBuilder->build(new CheeseburgerRecipe);

$hamburgerViewModel = new BurgerViewModel($hamburger->getName(), $priceTextRepresentationBuilder->build($hamburger->getPrice($euro)));
$cheeseburgerViewModel = new BurgerViewModel($cheeseburger->getName(), $priceTextRepresentationBuilder->build($cheeseburger->getPrice($euro)));
$burgerConsoleRenderer = new BurgerTextRenderer();

echo $burgerConsoleRenderer->render($hamburgerViewModel);
echo $burgerConsoleRenderer->render($cheeseburgerViewModel);


