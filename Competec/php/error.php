<?php

libxml_use_internal_errors(true);

$dom = new DOMDocument();
$rc = $dom->loadXML('<?xml version="1.0" ?><root>not closed');
var_dump(libxml_get_errors());
libxml_clear_errors();

echo $dom->saveXML();
