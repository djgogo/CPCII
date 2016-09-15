<?php
declare(strict_types = 1);
require_once 'autoload.php';

/* Validate CheckSum */
$invalidCheckSum = '0';
try {
    $invalidCheckSum = new ISBN('978-3-86680-192-0');
} catch (InvalidIsbnException $e) {
    printf("\nInvalid ISBN Check-Sum: %s \n", $invalidCheckSum);
}

$validCheckSum = '9';
try {
    $validCheckSum = new ISBN('978-3-86680-192-9');
} catch (InvalidIsbnException $e) {
    printf("\nInvalid ISBN Check-Sum: %s \n", $validCheckSum);
}

$invalidLength = '978-3-86680';
try {
    $invalidLength = new ISBN('978-3-86680');
} catch (InvalidIsbnException $e) {
    printf("\nInvalid ISBN Length: %s \n", $invalidLength);
}

$notDigits = '978-3-8668A-192-9';
try {
    $notDigits = new ISBN('978-3-8668A-192-9');
} catch (InvalidIsbnException $e) {
    printf("\nInvalid ISBN Number: %s \n", $notDigits);
}

$notDigits = '978-1-56619-9X9-4';
try {
    $notDigits = new ISBN('978-1-56619-9X9-4');
} catch (InvalidIsbnException $e) {
    printf("\nInvalid ISBN Number: %s \n", $notDigits);
}
