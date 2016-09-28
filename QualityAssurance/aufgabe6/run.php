<?php
declare(strict_types = 1);

require_once __DIR__ . '/bootstrap.php';

$finder = new Finder();
$classNames = $finder->findDeclarationsInDirectory('/var/www/Exercises/QualityAssurance/aufgabe6/src');
$finder->printClassNames($classNames);
