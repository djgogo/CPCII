<?php
declare(strict_types = 1);
require_once 'autoload.php';

$validIsbns = [];
$invalidIsbns = [];

$isbns = [
    '977-3-446-41394-8',
    '978-3-446-41394-8',
    '978-3-89864-450-1',
    '978-3-89864-451-1',
    '978-0-470-87249-9',
    '978-8-470-87249-9',
    '978-0-307-57878-7',
    '978-0-307-58778-7'
];

/* Validate ISBN Numbers */
foreach ($isbns as $isbn) {
    try {
        $isbnNumber = new ISBN($isbn);
        $validIsbns[] = $isbn;
    } catch (InvalidIsbnException $e) {
        $invalidIsbns[] = $isbn;
    }
}

printf("\nVALID ISBN NUMBERS:\n");
foreach ($validIsbns as $isbn) {
    printf("%s\n", $isbn);
}

printf("\nINVALID ISBN NUMBERS:\n");
foreach ($invalidIsbns as $isbn) {
    printf("%s\n", $isbn);
}

printf("\nAmount of ISBN Numbers: %s ", count($isbns));
printf("\nAmount of valid ISBN Numbers: %s ", count($validIsbns));
printf("\nAmount of invalid ISBN Numbers: %s ", count($invalidIsbns));
$percentOfInvalid = count($invalidIsbns) / count($isbns) * 100;
printf("\nPercent of invalid ISBN Numbers: %s%%\n", $percentOfInvalid);
