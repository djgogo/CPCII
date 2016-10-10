<?php
declare(strict_types = 1);
require_once 'autoload.php';

/* Prefix Validation  */
$invalidPrefix = '';
try {
    $invalidPrefix = new ISBN('999-3-86680-192-9');
} catch (InvalidIsbnException $e) {
    printf("\nInvalid ISBN Number %s \n", $invalidPrefix);
}

$validPrefix = '978';
try {
    $validPrefix = new ISBN('978-3-86680-192-9');
} catch (InvalidIsbnException $e) {
    printf("\nInvalid ISBN Number %s \n", $validPrefix);
}


