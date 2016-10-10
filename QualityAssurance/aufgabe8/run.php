<?php

require_once __DIR__ . '/bootstrap.php';

use PhpParser\NodeTraverser;
use PhpParser\ParserFactory;

$parser = (new ParserFactory)->create(ParserFactory::PREFER_PHP7);
$traverser = new NodeTraverser();

$finder = new Finder($parser, $traverser);
$classNames = $finder->findDeclarationsInDirectory('/var/www/Exercises/QualityAssurance/aufgabe8/src');
$finder->printClassNames($classNames);
