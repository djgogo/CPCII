<?php
declare(strict_types = 1);
require_once 'autoload.php';

$url2 = new URL('HTTP://www.anotherpage.com');
$temporaryRedirectHeader = new TemporaryRedirectHeader($url2);
