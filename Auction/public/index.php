<?php
$_SERVER['REQUEST_METHOD'] = 'POST';
$_SERVER['REQUEST_URI'] = '/bid';
$post['auction'] = '1';
$post['amount'] = '100';

require __DIR__ . '/../src/autoload.php';

$factory = new Factory;

$application = $factory->createApplication();

$application->run(Request::fromSuperGlobals(), new Response);
