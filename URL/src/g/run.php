<?php
declare(strict_types = 1);
require_once 'autoload.php';

try {
    $header = new OkStatusHeader();
    printf ("\nHeader Status: %s ", $header);
} catch (InvalidHTTPStatusHeaderException $e) {
    printf ("\nInvalid Header Status: %s ", $header);
}

try {
    $header = new NotFoundStatusHeader();
    printf ("\nHeader Status: %s \n", $header);
} catch (InvalidHTTPStatusHeaderException $e) {
    printf ("\nInvalid Header Status: %s \n", $header);
}
