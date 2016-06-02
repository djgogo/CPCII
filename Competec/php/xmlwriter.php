<?php

$oXMLWriter = new XMLWriter;
$oXMLWriter->openMemory();
$oXMLWriter->startDocument('1.0', 'UTF-8');

$oXMLWriter->startElement('test');
$oXMLWriter->text('Hello &test; <tag> World!');
//$oXMLWriter->endElement();

$oXMLWriter->endDocument();

echo $oXMLWriter->outputMemory(TRUE);
