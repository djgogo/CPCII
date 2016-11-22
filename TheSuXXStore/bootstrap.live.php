<?php

use Suxx\Factories\Factory;
use Suxx\Factories\PDOFactory;
use Suxx\FileHandlers\UploadedFile;
use Suxx\Http\Request;
use Suxx\Http\Response;
use Suxx\Http\Session;
use Suxx\Loggers\ErrorLogger;
use Suxx\ValueObjects\Token;

error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 1);
require __DIR__ . '/src/autoload.php';
require __DIR__ . '/vendor/autoload.php';
session_start();

/**
 * Create CSRF Protection Token
 */
if (empty($_SESSION['token'])) {
    $_SESSION['token'] = new Token();
}

/**
 * Create Templating Engine (Twig)
 */
$loader = new Twig_Loader_Filesystem(__DIR__ . '/templates');
$twig = new Twig_Environment($loader, ['cache' => false]);

/**
 * Create Request, Response and Session Objects
 */
$uploadedFile = new UploadedFile($_FILES);
$request = new Request($_REQUEST, $_SERVER, $uploadedFile);
$session = new Session($_SESSION);
$response = new Response();

/**
 * Create Database Handler and the Factory
 */
//$pdoFactory = new PDOFactory('localhost', 'suxx', 'suxxuser', 'thesuxxstore');
$pdoFactory = new PDOFactory('localhost', 'suxx', 'root', '1234', new ErrorLogger());
$factory  = new Factory($pdoFactory, $session);

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

/**
 * Render or Redirect
 */
if ($response->hasRedirect()) {
    $_SESSION = $session->getSessionData();
    header('Location: ' . $response->getRedirect(), 302);
} else {
    echo $twig->render($view, array('request' => $request, 'session' => $session, 'response' => $response));
    $_SESSION = $session->getSessionData();
}

