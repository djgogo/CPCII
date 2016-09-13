<?php

require __DIR__ . '/User.php';
require __DIR__ . '/PHPUserView.php';
require __DIR__ . '/UserView.php';

$user = new User(1, 'Reiner Zufall', 'Reiner@Zufall.net');
$user->setScreenName('Willy & Co');

$view = new PHPUserView();
$userView = new UserView($user);
echo $view->render($userView);
