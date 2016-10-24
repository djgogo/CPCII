<?php

error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 1);

require __DIR__ . '/autoload.php';
session_start();

$request = new SuxxRequest($_REQUEST);
$session = new SuxxSession($_SESSION);
$response = new SuxxResponse();

$_SESSION['token'] = new SuxxToken();

$pdoFactory = new PDOFactory('localhost', 'suxx', 'root', '1234');
$factory  = new SuxxFactory($pdoFactory);

$controller = $factory->getRouter()->route($request, $session);
$view = $controller->execute($request, $session, $response);

echo $view->render($request, $session, $response);
