<?php

/* Recipe */
$dom = new DOMDocument();
$dom->formatOutput = true;
$dom->preserveWhiteSpace = false;
$dom->load('hamburgerRecipe.xml');
$xp = new DOMXPath($dom);
$xp->registerNamespace('i', 'urn:burger-ingredients');

/* Ingredients */
$domPrices = new DOMDocument();
$domPrices->load('ingredients.xml');
$xpPrices = new DOMXPath($domPrices);
$xpPrices->registerNamespace('p', 'urn:burger-ingredients');

$shoppingList = $dom->createElementNS('urn:burger-shopping-list', 'bsl:shoppingList');

$total = 0;
$ingredients = array();

/* Shopping List Items */
foreach ($xp->query('//i:ingredient') as $ingredient) {
    $name = $ingredient->getAttribute('name');

    if (isset($ingredients[$name])) {
        $ingredients[$name] += 1;
        continue;
    }
    $ingredients[$name] = 1;
}

/* Ingredients Prices and Total */
foreach ($ingredients as $name => $amount) {
    $price = $xpPrices->query('//p:ingredient[@name = "'.$name.'"]')->item(0);

    if ($price !== null) {
        $total += $price->getAttribute('price') * $amount;

        $buy = $dom->createElementNS('urn:burger-shopping-list','bsl:buy', $name);
        $buy->setAttribute('price', $price->getAttribute('price'));
        $buy->setAttribute('amount', $amount);

        $shoppingList->appendChild($buy);
    }
}

$shoppingList->setAttribute('costs', $total);
$shoppingList->setAttribute('currency', $domPrices->documentElement->getAttribute('currency'));

$dom->documentElement->appendChild($shoppingList);

$dom->save('shopping-list.xml');