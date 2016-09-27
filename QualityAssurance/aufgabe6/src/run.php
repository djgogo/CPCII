<?php
declare(strict_types = 1);

use QualityAssurance\aufgabe6\Finder;

$finder = new Finder();
$classNames = $finder->findDeclarationsInDirectory('/var/www/Exercises/QualityAssurance/aufgabe6/src');
$finder->printClassNames($classNames);
