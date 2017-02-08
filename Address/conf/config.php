<?php
/**
 * AddressApp Configuration File
 */
$basePath = __DIR__ . '/../';

return [
    // Environment
    'production' => false,

    // Logger
    'errorLogPath' => $basePath . '/logs/error.log',

    // Twig Templates Path
    'twigPath' => $basePath . '/resources/views',

    // Database
    'host' => 'localhost',
    'database' => 'Cart',
    'user' => 'addressUser',
    'password' => 'addressApp',
    'charset' => 'utf8',
];
