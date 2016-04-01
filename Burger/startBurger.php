<?php
require_once __DIR__ . '/bootstrap.php';

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

//xml renderer creates burger-xml from burger view model
$burgerXmlRenderer = new BurgerXmlRenderer();

//xsl template to transform from burger-xml to html
$burgerDetailPageTemplate = new \TheSeer\fDOM\fDOMDocument();
$burgerDetailPageTemplate->loadXML(file_get_contents(__DIR__ . '/templates/burgerDetailPage.xsl'));

//the actual class that uses the template and a xsl processor to create the html
$xslRenderer = new XslRenderer($burgerDetailPageTemplate, new \TheSeer\fXSL\fXSLTProcessor());

$hamburgerDom = new \TheSeer\fDOM\fDOMDocument();
$hamburgerDom->loadXML($burgerXmlRenderer->render($hamburgerViewModel));

$cheeseburgerDom = new \TheSeer\fDOM\fDOMDocument();
$cheeseburgerDom->loadXML($burgerXmlRenderer->render($cheeseburgerViewModel));

$hamburgerDetailPageHtml = $xslRenderer->render($hamburgerDom);
$cheeseburgerDetailPageHtml = $xslRenderer->render($cheeseburgerDom);

echo $hamburgerDetailPageHtml->saveHTML();
echo $cheeseburgerDetailPageHtml->saveHTML();
