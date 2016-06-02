<?php

$dom = new DOMDocument();
$dom->formatOutput = true;
$dom->preserveWhiteSpace = false;
$dom->load(__DIR__ . '/../xml/sample.xml');

$node = $dom->createElementNS('urn:root', 'p:created');

var_dump($dom->documentElement->namespaceURI, $node->namespaceURI);

$dom->documentElement->appendChild($node);

$xml = $dom->saveXML();

echo $xml;

$dom2 = new DOMDocument();
$dom2->formatOutput = true;
$dom2->preserveWhiteSpace = false;
$dom2->loadXML($xml);

var_dump($dom2->documentElement->namespaceURI, $dom2->documentElement->lastChild->namespaceURI);
