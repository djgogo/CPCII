<?php
declare(strict_types = 1);
require_once 'autoload.php';

$isbn = new ISBN('978-3-446-41394-8');

/* Compare two equal ISBN Object Numbers */
$isbn1 = new ISBN('978-3-446-41394-8');
$isbn2 = new ISBN('978-3-446-41394-8');

if ($isbn->compare($isbn1, $isbn2) === true) {
    printf("\nCompared ISBN's are equal\n");
} else {
    printf("\nCompared ISBN's are NOT equal\n");
}

/* Compare two unequal ISBN Object Numbers */
$isbn1 = new ISBN('978-3-446-41394-8');
$isbn2 = new ISBN('978-3-89864-450-1');

if ($isbn->compare($isbn1, $isbn2) === true) {
    printf("\nCompared ISBN's are equal\n");
} else {
    printf("\nCompared ISBN's are NOT equal\n");
}

