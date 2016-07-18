<?php
declare(strict_types = 1);
require_once __DIR__ . '/bootstrap.php';

$peter = new User('Peter');
$anna = new User('Anna');
$friendRequest1 = new FriendRequest($anna, $peter);
$peter->addFriendRequest($friendRequest1);
// produce error
$peter->addFriendRequest($friendRequest1);
$peter->confirm($friendRequest1);

$friendRequest2 = new FriendRequest($peter, $anna);
$anna->addFriendRequest($friendRequest2);
$anna->decline($friendRequest2);


