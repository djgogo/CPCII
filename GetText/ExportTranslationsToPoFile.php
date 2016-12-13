<?php
declare(strict_types = 1);

use GetText\MySqlToPoExporter;
use GetText\PDOFactory;

require_once __DIR__ . '/bootstrap.php';

/**
 * MySql Credentials & default charset
 */
$host = 'localhost';
$dbName = 'i18n';
$user = 'root';
$password = '1234';
$charset = 'utf8';

/**
 * New Po GetText-Translation Filename
 */
$filename = __DIR__ . '/getTextFile/messages.po';

/**
 * Database Handler
 */
$pdoFactory = new PDOFactory($host, $dbName, $user, $password, $charset);

/**
 * Export Translations from MySql Database
 */
$parser = new MySqlToPoExporter($pdoFactory);
$parser->export();

/**
 * Write Po-File
 */
$parser->writePoGetTextFile($filename);

printf("Es wurden %d Datensätze erfolgreich in das Po-File %s exportiert \n", $parser->getProcessedEntries(), $filename);
