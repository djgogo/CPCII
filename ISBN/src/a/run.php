<?php
declare(strict_types = 1);
require_once 'autoload.php';

$isbnHyphens = new ISBN('978-3-86680-192-9');
$isbnBlanks = new ISBN('978 3 86680 192 9');

printf ("\nISBN with Hyphens: %s", $isbnHyphens);
printf ("\nISBN without Hyphens: %s \n", $isbnBlanks);
