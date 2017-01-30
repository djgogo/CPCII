<?php

use Address\Http\Request;
use Address\Http\Session;
use Address\Http\Response;
use Address\Factories\Factory;
use Address\Factories\PDOFactory;
use Address\ValueObjects\Token;

/**
 * only for development/debugging - delete following two lines in production version
 */
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 1);

require __DIR__ . '/src/autoload.php';
require __DIR__ . '/vendor/autoload.php';

$errorLogPath = __DIR__ . '/logs/error.log';

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
$loader = new Twig_Loader_Filesystem(__DIR__ . '/resources/views');
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
//$pdoFactory = new PDOFactory('localhost', 'Cart', 'addressuser', '1234');
$pdoFactory = new PDOFactory('localhost', 'Cart', 'root', '1234', 'utf8');
$factory  = new Factory($session, $pdoFactory, $errorLogPath);

/**
 * Get the Router and Controller for execution
 */
$routers = $factory->getRouters();
foreach ($routers as $router) {
    /** @var $router Address\Routers\RouterInterface */
    $controller = $router->route($request);
    if ($controller != null) {
        break;
    }
}

/**
 * Get the View and execute
 * @var $controller Address\Controllers\ControllerInterface
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
