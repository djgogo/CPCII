<?php
require_once 'autoload.php';

$ingredientFactory = new IngredientFactory();
$ingredientRepository = new IngredientRepository();
$ingredientLocator = new IngredientLocator($ingredientRepository);

$ingredientRepository->addIngredient($ingredientFactory->createSalad());
$ingredientRepository->addIngredient($ingredientFactory->createSalad());
$ingredientRepository->addIngredient($ingredientFactory->createSauce());
$ingredientRepository->addIngredient($ingredientFactory->createSauce());
$ingredientRepository->addIngredient($ingredientFactory->createLowerBread());
$ingredientRepository->addIngredient($ingredientFactory->createLowerBread());
$ingredientRepository->addIngredient($ingredientFactory->createUpperBread());
$ingredientRepository->addIngredient($ingredientFactory->createUpperBread());
$ingredientRepository->addIngredient($ingredientFactory->createTomato());
$ingredientRepository->addIngredient($ingredientFactory->createTomato());
$ingredientRepository->addIngredient($ingredientFactory->createPatty());
$ingredientRepository->addIngredient($ingredientFactory->createPatty());
$ingredientRepository->addIngredient($ingredientFactory->createCheese());

$burgerBuilder = new BurgerBuilder($ingredientLocator);
$priceFormatter = new PriceFormatter();

$hamburger = $burgerBuilder->build(new HamburgerRecipe());
$cheeseburger = $burgerBuilder->build(new CheeseburgerRecipe());

echo "Hamburger:\n" . burgerStringRepresentation($hamburger, $priceFormatter);
echo "Cheeseburger:\n" . burgerStringRepresentation($cheeseburger, $priceFormatter);

/**
 * @param Burger $burger
 * @param PriceFormatter $priceFormatter
 * @return string
 */
function burgerStringRepresentation(Burger $burger, PriceFormatter $priceFormatter)
{
    $representation = "-- Zutaten: \n";

    foreach ($burger->getIngredients() as $ingredient) {
        $representation .= sprintf(
            "-- -- %s: %s\n",
            $ingredient->getName(),
            $priceFormatter->format((string)$ingredient->getPrice())
        );
    }

    $representation .= sprintf("-- Totalpreis: %s\n", $priceFormatter->format((string)$burger->getPrice()));

    return $representation;
}