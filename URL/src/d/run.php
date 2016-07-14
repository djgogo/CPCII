<?php
declare(strict_types = 1);
require_once 'autoload.php';

$url = new URL('http://example.com/path');
$subPath = 'sub/directory';

/* Concatinate SubPath to URL and get a new complete URL  */
printf ("Complete URL: %s \n", $url->concatUrlWithSubPath($subPath));

/* with slash */
$subPath = '/sub/directory';
printf ("Complete URL: %s \n", $url->concatUrlWithSubPath($subPath));
