<?php

/* Recipe */
$dom = new DOMDocument();
$dom->formatOutput = true;
$dom->preserveWhiteSpace = false;
$dom->load('hamburgerRecipe.xml');
$xp = new DOMXPath($dom);
$xp->registerNamespace('ing', 'urn:burger-ingredients');

/* Ingredients */
$domPrices = new DOMDocument();
$domPrices->load('ingredients.xml');
$xpPrices = new DOMXPath($domPrices);
$xpPrices->registerNamespace('prices', 'urn:burger-ingredients');

$shoppingList = $dom->createElementNS('', 'shoppingList');

$total = 0;
$ingredients = array();

/* Shopping List Items */
foreach ($xp->query('//ing:ingredient') as $ingredient) {
    $name = $ingredient->getAttribute('name');

    if (!isset($ingredients[$name])) {
        $ingredients[$name] = 0;
    }
    $ingredients[$name]++;
}

/* Ingredients Prices and Total */
foreach ($ingredients as $name => $amount) {
    $price = $xpPrices->query('//prices:ingredient[@name = "'.$name.'"]')->item(0);

    if ($price !== null) {
        $total += $price->getAttribute('price') * $amount;

        $buy = $dom->createElementNS('', 'buy');
        $buy->setAttribute('name', $name);
        $buy->setAttribute('price', $price->getAttribute('price'));
        $buy->setAttribute('amount', $amount);

        $shoppingList->appendChild($buy);
    }
}

$shoppingList->setAttribute('costs', $total);
$shoppingList->setAttribute('currency', $xpPrices->query('/prices:ingredients')->item(0)->getAttribute('currency'));

$xp->document->documentElement->appendChild($shoppingList);

var_export($dom->saveXML());
