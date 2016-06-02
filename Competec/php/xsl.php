<?php

$tpl = new DOMDocument();
$tpl->load(__DIR__ . '/../xsl/template4.xsl');

$xsl = new XSLTProcessor();
$xsl->importStylesheet($tpl);


$dom = new DOMDocument();
$dom->load(__DIR__ . '/../xml/list.xml');

$xsl->setParameter('', 'test', 'Reiner Zufall');
echo $xsl->transformToXml($dom);
