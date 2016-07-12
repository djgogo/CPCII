<?php
declare(strict_types = 1);
require_once 'autoload.php';

$isbns = [
    '977-3-446-41394-8',
    '978-3-446-41394-8',
    '978-3-89864-450-1',
    '978-3-89864-451-1',
    '978-0-470-87249-9',
    '978-8-470-87249-9',
    '078-0-307-57878-7',
    '078-0-307-58878-7'
];

/* Validate ISBN Number */
foreach ($isbns as $isbn) {
    try {
        $isbnNumber = new ISBN($isbn);
    } catch (InvalidIsbnException $e) {
        printf("\nInvalid ISBN Number: %s \n", $isbnNumber);
    }
}

