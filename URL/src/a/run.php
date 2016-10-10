<?php
declare(strict_types = 1);
require_once 'autoload.php';

// Invalid URL's

/* URL with ftp */
$invalidUrl = 'FTP://max:muster@ftp.example.com';
try {
    $invalidUrl = new URL($invalidUrl);
} catch (InvalidUrlException $e) {
    printf("\nInvalid URL: %s \n", $invalidUrl);
}
/* URL with User and Password */
$invalidUrl = 'HTTPS://max:muster@www.example.com';
try {
    $invalidUrl = new URL($invalidUrl);
} catch (InvalidUrlException $e) {
    printf("\nInvalid URL: %s \n", $invalidUrl);
}
/* URL with Port */
$invalidUrl = 'HTTPS://www.example.com:8080';
try {
    $invalidUrl = new URL($invalidUrl);
} catch (InvalidUrlException $e) {
    printf("\nInvalid URL: %s \n", $invalidUrl);
}
/* URL with Query */
$invalidUrl = 'HTTPS://www.example.com/index.php?p1=foo';
try {
    $invalidUrl = new URL($invalidUrl);
} catch (InvalidUrlException $e) {
    printf("\nInvalid URL: %s \n", $invalidUrl);
}
/* URL with Fragment */
$invalidUrl = 'HTTPS://www.example.com/index.php?p1=foo#ressource';
try {
    $invalidUrl = new URL($invalidUrl);
} catch (InvalidUrlException $e) {
    printf("\nInvalid URL: %s \n", $invalidUrl);
}

$invalidUrl = 'FTP://example.com';
try {
    $invalidUrl = new URL($invalidUrl);
} catch (InvalidUrlException $e) {
    printf("\nInvalid URL: %s \n", $invalidUrl);
}

// Valid URL's

$validUrl = 'HTTP://example.com';
try {
    $validUrl = new URL($validUrl);
    printf("\nValid URL: %s \n", $validUrl);
} catch (InvalidUrlException $e) {
    printf("\nInvalid URL: %s \n", $validUrl);
}

$validUrl = 'HTTPS://example.com';
try {
    $validUrl = new URL($validUrl);
    printf("\nValid URL: %s \n", $validUrl);
} catch (InvalidUrlException $e) {
    printf("\nInvalid URL: %s \n", $validUrl);
}
