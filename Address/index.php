<?php

use Address\Http\Request;
use Address\Http\Session;
use Address\Http\Response;
use Address\Factories\Factory;

error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 1);

require __DIR__ . '/src/autoload.php';
require __DIR__ . '/vendor/autoload.php';

$errorLogPath = __DIR__ . '/logs/error.log';

session_start();

/**
 * Create Templating Engine (Twig)
 */
$loader = new Twig_Loader_Filesystem(__DIR__ . '/resources');
$twig = new Twig_Environment($loader, ['cache' => false]);

/**
 * HTTP relevant files
 */
$session = new Session($_SESSION);
$request = new Request($_REQUEST, $_SERVER);
$response = new Response();

/**
 * Create Database Handler and the Factory
 */
//$pdoFactory = new PDOFactory('localhost', 'suxx', 'suxxuser', 'thesuxxstore');
//$pdoFactory = new PDOFactory('localhost', 'suxx', 'root', '1234');
$factory  = new Factory($session);

/**
 * Get the Router and Controller for execution
 */
$routers = $factory->getRouters();
foreach ($routers as $router) {
    $controller = $router->route($request);
    if ($controller != null) {
        break;
    }
}

/**
 * Get the View and execute
 */
$view = $controller->execute($request, $response);

echo $twig->render($view);
