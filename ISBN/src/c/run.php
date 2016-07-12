    <?php
declare(strict_types = 1);
require_once 'autoload.php';

$isbnHyphens = new ISBN('978-3-86680-192-9');
$isbnBlanks = new ISBN('978 3 86680 192 9');

printf ("\nInput ISBN with Hyphens: %s", $isbnHyphens);
printf ("\nInput ISBN without Hyphens: %s \n", $isbnBlanks);

$wrongPrefix = '';
try {
    $wrongPrefix = new ISBN('999-3-86680-192-9');
} catch (InvalidIsbnException $e) {
    printf ("\nInvalid ISBN Number %s \n", $wrongPrefix);
}


