<?php
declare(strict_types = 1);
require_once 'autoload.php';

$url = new URL('HTTP://www.example.com');
$permanentRedirectHeader = new PermanentRedirectHeader($url);
