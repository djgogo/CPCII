<?php

$dom = new DOMDocument();
$dom->load(__DIR__ . '/../work1/team2/recipe.xml');

$xp = new DOMXPath($dom);
$xp->registerNamespace('foo', 'urn:burger-ingredient');

foreach($xp->query('//foo:ingredient[@name="' . $name . '" or @name="cheese"]') as $element) {
    var_dump($element->getAttribute('name'));
}


