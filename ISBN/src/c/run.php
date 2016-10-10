<?php
declare(strict_types = 1);
require_once 'autoload.php';

/* GroupNumber Validation */
$invalidGroupNo = '978-8-86680-192-9';
try {
    $invalidGroupNo = new ISBN($invalidGroupNo);
} catch (InvalidIsbnException $e) {
    printf("\nInvalid ISBN Group-Number: %s \n", $invalidGroupNo);
}

$validGroupNo = '978-7-86680-192-9';
try {
    $validGroupNo = new ISBN($validGroupNo);
} catch (InvalidIsbnException $e) {
    printf("\nInvalid ISBN Group-Number: %s \n", $validGroupNo);
}

$invalidGroupNo = '979-13-86680-192-9';
try {
    $invalidGroupNo = new ISBN($invalidGroupNo);
} catch (InvalidIsbnException $e) {
    printf("\nInvalid ISBN Group-Number: %s \n", $invalidGroupNo);
}

$validGroupNo = '979-10-86680-192-9';
try {
    $validGroupNo = new ISBN($validGroupNo);
} catch (InvalidIsbnException $e) {
    printf("\nInvalid ISBN Group-Number: %s \n", $validGroupNo);
}

$invalidLength = '979-10-86680';
try {
    $invalidLength = new ISBN($invalidLength);
} catch (InvalidIsbnException $e) {
    printf("\nInvalid ISBN Number Length: %s \n", $invalidLength);
}

