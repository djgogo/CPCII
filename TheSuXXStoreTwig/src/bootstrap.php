<?php

error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 1);

require __DIR__ . '/autoload.php';
require __DIR__ . '/../vendor/autoload.php';
session_start();

if (empty($_SESSION['token'])) {
    $_SESSION['token'] = new SuxxToken();
}

$loader = new Twig_Loader_Filesystem(__DIR__ . '/../templates');
$twig = new Twig_Environment($loader, ['cache' => false]);

$request = new SuxxRequest($_REQUEST, $_FILES);
$session = new SuxxSession($_SESSION);
$response = new SuxxResponse();

$pdoFactory = new PDOFactory('localhost', 'suxx', 'suxxuser', 'thesuxxstore');
$factory  = new SuxxFactory($pdoFactory, $session);

$controller = $factory->getRouter()->route($request);
$view = $controller->execute($request, $session, $response);

if ($response->hasRedirect()) {
    $_SESSION = $session->getSessionData();
    header('Location: ' . $response->getRedirect(), 302);
} else {
    echo $twig->render($view, array('request' => $request, 'session' => $session, 'response' => $response));
    $_SESSION = $session->getSessionData();
}

