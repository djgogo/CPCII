<?php
declare(strict_types = 1);

use CodeReview\e\Counter;

require_once __DIR__ . '/bootstrap.php';

$counter = new Counter();
$counter->increment();
var_dump($counter->getCounter());

$counter = new Counter(PHP_INT_MAX);
$counter->increment();
var_dump($counter->getCounter());

var_dump((int)$counter->getCounter());
