<?php

$dom = new DOMDocument();
$dom->preserveWhiteSpace = false;
$dom->load(__DIR__ . '/../xml/sample2.xml');

$target = new DOMDocument();
$target->preserveWhiteSpace = false;
$target->formatOutput = true;
$target->load(__DIR__ . '/../xml/sample.xml');

$fragment = $target->createDocumentFragment();
foreach ($dom->documentElement->childNodes as $node) {
    $fragment->appendChild($target->importNode($node, true));
}

var_dump($fragment);

$target->documentElement->appendChild($fragment);
echo $target->saveXML();
