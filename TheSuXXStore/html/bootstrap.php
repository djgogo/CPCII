<?php

error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 1);

require __DIR__ . '/autoload.php';
session_start();

$request  = new SuxxRequest($_REQUEST, $_SESSION);
$response = new SuxxResponse();

$pdoFactory = new PDOFactory('localhost', 'suxx', 'root', '1234');
$factory  = new SuxxFactory($pdoFactory);

$processor = $factory->getRouter()->route($request);
$view = $processor->execute($request, $response);

echo $view->render($request, $response);
