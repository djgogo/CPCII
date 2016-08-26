<?php

require __DIR__ . '/User.php';
require __DIR__ . '/PHPUserView.php';

$user = new User(1, 'Reiner Zufall', 'Reiner@Zufall.net');
$user->setScreenName('Willy & Co');

$view = new PHPUserView();
echo $view->render($user);
