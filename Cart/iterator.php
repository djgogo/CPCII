<?php

$foo = new SplObjectStorage();

$stdclass = new stdClass();
$stdclass->foo = 'bar';

$foo->attach($stdclass);

$stdclass = new stdClass();
$stdclass->hello = 'world';

$foo->attach($stdclass);


$iterator = new IteratorIterator($foo);

foreach ($iterator as $item) {
    var_dump($item);
}

var_dump($iterator->getInnerIterator()); // Böse!


class iHatePhPIterator extends IteratorIterator
{
    public function getInnerIterator()
    {
        throw new \Exception('get out!');
    }
}

$secureIterator = new iHatePhPIterator($foo);

foreach ($secureIterator as $item) {
    var_dump($item);
}

var_dump($secureIterator->getInnerIterator()); // Böse!


