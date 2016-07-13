<?php
declare(strict_types = 1);
require_once 'autoload.php';

/* Validate CheckSum */
$invalidCheckSum = '0';
try {
    $invalidCheckSum = new ISBN('978-3-86680-192-0');
} catch (InvalidIsbnException $e) {
    printf ("\nInvalid ISBN Check-Sum: %s \n", $invalidCheckSum);
}

$validCheckSum = '9';
try {
    $validCheckSum = new ISBN('978-3-86680-192-9');
} catch (InvalidIsbnException $e) {
    printf ("\nInvalid ISBN Check-Sum: %s \n", $validCheckSum);
}
