<?php
declare(strict_types = 1);

use GetText\PDOFactory;
use GetText\PoToMySqlImporter;
use GetText\PoParser;

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
 * Po Gettext-Translation File Location
 */
$filePath = '/var/www/Competec/AlltronStore/locale/fr_CH/LC_MESSAGES/messages.po';

/**
 * Database Handler
 */
$pdoFactory = new PDOFactory($host, $dbName, $user, $password, $charset);

/**
 * Parse Po Gettext File
 */
$parser = new PoParser($filePath);
$poData = $parser->parse();

printf("Es wurden %d Translations aus dem Po-File verarbeitet. \n", $parser->getProcessedTranslations());

/**
 * Write Po-Data into MySql Database
 */
$mySqlWriter = new PoToMySqlImporter($pdoFactory);
$mySqlWriter->import($poData);

printf("Es wurden %d Datensätze erfolgreich in die MySql Datenbank %s importiert \n", $mySqlWriter->getProcessedEntries(), $dbName);
