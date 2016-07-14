<?php
declare(strict_types = 1);
require_once 'autoload.php';

/* Valid Headers */
$headerStatus = 200;
try {
    $header = new HTTPStatusHeader($headerStatus);
    //header((string)$header);
    echo $header;
} catch (InvalidHTTPStatusHeaderException $e) {
    printf ("\nInvalid Header Status: %s \n", $headerStatus);
}
$headerStatus = 404;
try {
    $header = new HTTPStatusHeader($headerStatus);
    //header((string)$header);
    echo $header;
} catch (InvalidHTTPStatusHeaderException $e) {
    printf ("\nInvalid Header Status: %s \n", $headerStatus);
}

/* Invalid Headers */
$headerStatus = 999;
try {
    $header = new HTTPStatusHeader($headerStatus);
    echo $header;
} catch (InvalidHTTPStatusHeaderException $e) {
    printf ("\nInvalid Header Status: %s \n", $headerStatus);
}

