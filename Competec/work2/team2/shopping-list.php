<?php
$recipeDom = new DOMDocument();
$recipeDom->preserveWhiteSpace = false;
$recipeDom->formatOutput = true;
$recipeDom->load(__DIR__ . '/burger-recipe.xml');

$ingredientsInRecipe = $recipeDom->documentElement->getElementsByTagName('ingredients')->item(0)->childNodes;

$ingredientsDom = new DOMDocument();
$ingredientsDom->preserveWhiteSpace = false;
$ingredientsDom->load(__DIR__ . '/ingredients.xml');

$ingredientsXpath = new DOMXPath($ingredientsDom);
$ingredientsXpath->registerNamespace('i', 'urn:burger-ingredient');

$arrayItemsAmount = [];

$sum = 0;

foreach ($ingredientsInRecipe as $ingredient) {

    if (!array_key_exists($ingredient->localName, $arrayItemsAmount)) {
        $arrayItemsAmount[$ingredient->localName] = 0;
    }
    $arrayItemsAmount[$ingredient->localName]++;

    $priceFromList = $ingredientsXpath->query('//i:' . $ingredient->localName . '//i:price[@currency="EUR"]')->item(0)->nodeValue;
    $sum  += (int)$priceFromList;
}

$resultXml = new DOMDocument();
$resultXml->formatOutput = true;

$shoppingListElement = $resultXml->createElementNS('urn:burger-shopping-list', 'bsl:shoppingList');
$resultXml->appendChild($shoppingListElement);

// items
$shoppingItems = $resultXml->createElementNS('urn:burger-shopping-list', 'bsl:shoppingItems');

foreach ($arrayItemsAmount as $itemName => $itemAmount) {

    $shoppingItemElement = $resultXml->createElementNS('urn:burger-shopping-list', 'bsl:buy');
    $shoppingItemElement->setAttribute('name', $itemName);
    $shoppingItemElement->setAttribute('amount', $itemAmount);

    $shoppingItems->appendChild($shoppingItemElement);
}

$shoppingListElement->appendChild($shoppingItems);

// price
$totalPriceElement = $resultXml->createElementNS('urn:burger-shopping-list', 'bsl:cost');
$totalPriceElement->setAttribute('total', $sum);
$totalPriceElement->setAttribute('currency', 'EUR');
$shoppingListElement->appendChild($totalPriceElement);

$shoppingList = $recipeDom->importNode($resultXml->documentElement, true);
$recipeDom->documentElement->appendChild($shoppingList);

echo $recipeDom->saveXML();
