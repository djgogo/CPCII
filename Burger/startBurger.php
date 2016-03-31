<?php
require_once 'autoload.php';

$collectionFactory = new CollectionFactory();
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

$burgerBuilder = new BurgerBuilder($ingredientRepository, $collectionFactory);

$hamburger = $burgerBuilder->build(new HamburgerRecipe($collectionFactory->createIngredientNameCollection()));
$cheeseburger = $burgerBuilder->build(new CheeseburgerRecipe($collectionFactory->createIngredientNameCollection()));

echo "Hamburger:\n" . burgerStringRepresentation($hamburger);
echo "Cheeseburger:\n" . burgerStringRepresentation($cheeseburger);

/**
 * @param Burger $burger
 * @return string
 */
function burgerStringRepresentation(Burger $burger)
{
    $representation = sprintf("-- Preis: %s\n", (string) $burger->getPrice());

    return $representation;
}