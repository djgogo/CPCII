<?php

$data = new DOMDocument();
$data->load(__DIR__ . '/../xml/shopping-list.xml');

$template = new DOMDocument();
$template->load(__DIR__ . '/../xsl/shoppingList.xsl');

$xsl = new XSLTProcessor();
$xsl->importStylesheet($template);

echo $xsl->transformToXml($data);