<?php
declare(strict_types = 1);

require_once __DIR__ . 'vendor/autoload.php';
ini_set('xdebug.max_nesting_level', 3000);

use PhpParser\ParserFactory;
$parser = (new ParserFactory)->create(ParserFactory::PREFER_PHP7);


