<?php
declare(strict_types = 1);
require_once 'autoload.php';

// Invalid URL's

/* URL with ftp */
$invalidUrl = 'ftp://max:muster@ftp.example.com';
try {
    $invalidUrl = new URL('ftp://max:muster@ftp.example.com');
} catch (InvalidUrlException $e) {
    printf ("\nInvalid URL: %s \n", $invalidUrl);
}
/* URL with User and Password */
$invalidUrl = 'https://max:muster@www.example.com';
try {
    $invalidUrl = new URL('https://max:muster@www.example.com');
} catch (InvalidUrlException $e) {
    printf ("\nInvalid URL: %s \n", $invalidUrl);
}
/* URL with Port */
$invalidUrl = 'https://www.example.com:8080';
try {
    $invalidUrl = new URL('https://www.example.com:8080');
} catch (InvalidUrlException $e) {
    printf ("\nInvalid URL: %s \n", $invalidUrl);
}
/* URL with Query */
$invalidUrl = 'https://www.example.com/index.php?p1=foo';
try {
    $invalidUrl = new URL('https://www.example.com/index.php?p1=foo');
} catch (InvalidUrlException $e) {
    printf ("\nInvalid URL: %s \n", $invalidUrl);
}
/* URL with Fragment */
$invalidUrl = 'https://www.example.com/index.php?p1=foo#ressource';
try {
    $invalidUrl = new URL('https://www.example.com/index.php?p1=foo#ressource');
} catch (InvalidUrlException $e) {
    printf ("\nInvalid URL: %s \n", $invalidUrl);
}

$invalidUrl = 'ftp://example.com';
try {
    $invalidUrl = new URL('ftp://example.com');
} catch (InvalidUrlException $e) {
    printf ("\nInvalid URL: %s \n", $invalidUrl);
}

// Valid URL's

$invalidUrl = 'http://example.com';
try {
    $invalidUrl = new URL('http://example.com');
} catch (InvalidUrlException $e) {
    printf ("\nInvalid URL: %s \n", $invalidUrl);
}

$invalidUrl = 'https://example.com';
try {
    $invalidUrl = new URL('https://example.com');
} catch (InvalidUrlException $e) {
    printf ("\nInvalid URL: %s \n", $invalidUrl);
}
