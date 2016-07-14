<?php
declare(strict_types = 1);
require_once 'autoload.php';

// A valid Subpath

$url1 = new URL('http://example.com/path/sub/directory');
$url2 = new URL('http://example.com/path');

// Compare two URL Path's
if ($url1->isSubPathOf($url2)) {
    printf ("\nURL1: %s is a SubPath of URL2: %s \n", $url1, $url2);
} else {
    printf ("\nURL1: %s is NOT a SubPath of URL2: %s \n", $url1, $url2);
}

// print SubPath
try {
    printf ("SubPath: %s \n", $url1->getSubPath($url2));
} catch (InvalidUrlException $e) {
    printf ("Invalid SubPath: %s \n", $url1);
}

// Invalid Subpath

$url1 = new URL('http://example.com/path/sub/directory');
$url2 = new URL('http://example.com/anotherPath');

// Compare two URL Path's
if ($url1->isSubPathOf($url2)) {
    printf ("\nURL1: %s is a SubPath of URL2: %s \n", $url1, $url2);
} else {
    printf ("\nURL1: %s is NOT a SubPath of URL2: %s \n", $url1, $url2);
}

// print SubPath
try {
    printf ("SubPath: %s \n", $url1->getSubPath($url2));
} catch (InvalidUrlException $e) {
    printf ("Invalid SubPath: %s \n", $url1);
}

