<?php
declare(strict_types = 1);
require_once 'autoload.php';

$url1 = new URL('HTTPS://www.example.com');
$url2 = new URL('HTTPS://www.example.com');
$url3 = new URL('HTTP://www.other.com');

if ($url1->equalsTo($url2)) {
    printf("\nURL1: %s is equal URL2: %s \n", $url1, $url2);
} else {
    printf("\nURL1: %s is NOT equal URL2: %s \n", $url1, $url2);
}

if ($url1->equalsTo($url3)) {
    printf("\nURL1: %s is equal URL2: %s \n", $url1, $url3);
} else {
    printf("\nURL1: %s is NOT equal URL2: %s \n", $url1, $url3);
}
