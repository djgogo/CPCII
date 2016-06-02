<?php

$reader = new XMLReader();
$reader->open(__DIR__ . '/../xml/list.xml');

while($reader->read()) {
    if ($reader->nodeType === $reader::ELEMENT && $reader->localName === 'entry') {
        $dom = new DOMDocument();
        $node = $reader->expand();
        $ref = $dom->importNode($node, true);
        echo '[' . $dom->saveXML($ref) . "]\n";
    }

}
