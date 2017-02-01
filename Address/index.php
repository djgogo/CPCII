<?php

use Address\Http\Request;
use Address\Http\Session;
use Address\Http\Response;
use Address\Factories\Factory;
use Address\Factories\PDOFactory;
use Address\ValueObjects\Token;
use Address\Configuration\Configuration;

require __DIR__ . '/src/autoload.php';
require __DIR__ . '/vendor/autoload.php';

/**
 * Configuration
 */
$configuration = new Configuration(__DIR__ . '/conf/config.php');

/**
 * only for development/debugging - delete following two lines in production version
 */
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 1);

session_start();

/**
 * CSRF Protection Token
 */
if (empty($_SESSION['token'])) {
    $_SESSION['token'] = new Token();
}

/**
 * Templating Engine (Twig)
 */
$loader = new Twig_Loader_Filesystem($configuration->getTwigTemplatePath());
$twig = new Twig_Environment($loader, ['cache' => false]);

/**
 * HTTP relevant Objects
 */
$session = new Session($_SESSION);
$request = new Request($_REQUEST, $_SERVER);
$response = new Response();

/**
 * Database Handler and the Factory
 */
$pdoFactory = new PDOFactory(
    $configuration->getDatabaseHost(),
    $configuration->getDatabaseName(),
    $configuration->getDatabaseUser(),
    $configuration->getDatabasePassword(),
    $configuration->getDatabaseCharset()
);

$factory  = new Factory($session, $pdoFactory, $configuration->getErrorLogPath());

/**
 * Router and Controller for execution
 */
$routers = $factory->getRouters();
foreach ($routers as $router) {
    /** @var $router Address\Routers\RouterInterface */
    $controller = $router->route($request);
    if ($controller !== null) {
        break;
    }
}

/**
 * View
 * @var $controller Address\Controllers\ControllerInterface
 */
$view = $controller->execute($request, $response);

/**
 * Render or Redirect
 */
if ($response->hasRedirect()) {
    $_SESSION = $session->getSessionData();
    header('Location: ' . $response->getRedirect(), 302);
    exit();
}
echo $twig->render($view, array('request' => $request, 'session' => $session, 'response' => $response));
$_SESSION = $session->getSessionData();

