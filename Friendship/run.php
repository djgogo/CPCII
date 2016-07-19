<?php
declare(strict_types = 1);
require_once __DIR__ . '/bootstrap.php';

$peter = new User('Peter');
$anna = new User('Anna');
$stefan = new User('Stefan');

$friendRequest1 = new FriendRequest($anna, $peter);
$peter->addFriendRequest($friendRequest1);

// already added - error
$peter->addFriendRequest($friendRequest1);
$peter->confirm($friendRequest1);

$friendRequest2 = new FriendRequest($peter, $anna);
$anna->addFriendRequest($friendRequest2);
$anna->decline($friendRequest2);

// Confirmation without a previous request - error
$friendRequest3 = new FriendRequest($peter, $anna);
$anna->confirm($friendRequest3);

// try to remove a friend which is not one - error
$peter->removeFriend($stefan);
// remove a friend
$peter->removeFriend($anna);
