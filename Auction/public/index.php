<?php
$_SERVER['REQUEST_METHOD'] = 'POST';
$_SERVER['REQUEST_URI'] = '/bid';
$_POST['auction'] = '1';
$_POST['amount'] = '100';

require __DIR__ . '/../src/autoload.php';

$factory = new Factory;

$application = $factory->createApplication();

$application->run(Request::fromSuperGlobals(), new Response);
