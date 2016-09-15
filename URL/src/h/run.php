<?php
declare(strict_types = 1);
require_once 'autoload.php';

$okStatusHeader = new OkStatusHeader();
$url = new URL('HTTP://www.example.com');

$locationHeader = new LocationHeader($url);
$locationHeader->send($okStatusHeader);

printf("\n *** Redirected to: %s \n", $url);

