<?php
declare(strict_types = 1);
use GetText\PoParser;

require_once __DIR__ . '/bootstrap.php';

$filePath = '/var/www/Competec/AlltronStore/locale/fr_CH/LC_MESSAGES/messages.po';
$parser = new PoParser($filePath);

$parser->parse();

$parser->printPoFile();
