<?php

class MyDomDocument extends DOMDocument {

    public function foo() {
        return 'abc!!!';
    }

}


class MyDomElement extends DOMElement {

    public function foo() {
        return $this->ownerDocument->foo();
    }

}


$dom = new MyDOMDocument();
$dom->registerNodeClass('DOMDocument', MyDomDocument::class);
$dom->registerNodeClass('DOMElement', MyDomElement::class);

$dom->loadXML('<?xml version="1.0" ?><root />');

var_dump($dom->documentElement->foo());
