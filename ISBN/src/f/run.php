<?php
declare(strict_types = 1);
require_once 'autoload.php';

$isbn = new ISBN('978-3-446-41394-8');

/* Compare two equal ISBN Numbers */
$isbn1 = '978-3-446-41394-8';
$isbn2 = '978-3-446-41394-8';

$diff = $isbn->compareIsbn($isbn1, $isbn2);
if (count($diff) == 0) {
    printf("\nCompared ISBN's are equal\n");
} else {
    print_r($diff);
}

/* Compare two unequal ISBN Numbers */
$isbn1 = '978-3-446-41394-8';
$isbn2 = '978-3-89864-450-1';

$diff = $isbn->compareIsbn($isbn1, $isbn2);
if (count($diff) == 0) {
    printf("\nCompared ISBN's are equal\n");
} else {
    print_r($diff);
}

