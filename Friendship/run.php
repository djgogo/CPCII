<?php
declare(strict_types = 1);
require_once __DIR__ . '/bootstrap.php';

$peter = new User('Peter');
$anna = new User('Anna');
$stefan = new User('Stefan');

// Friend Request from Anna to Peter
$friendRequest1 = new FriendRequest($anna, $peter);
$peter->addFriendRequest($friendRequest1);

// already added - error
$peter->addFriendRequest($friendRequest1);
// Peter confirms Anna's Request
$peter->confirm($friendRequest1);
// try to confirm again! Error!
$peter->confirm($friendRequest1);

// Friend Request from Peter to Anna
$friendRequest2 = new FriendRequest($peter, $anna);
// Peter is already Friend of Anna - Error!
$anna->addFriendRequest($friendRequest2);

// Friend Request from Anna to Stefan
$friendRequest3 = new FriendRequest($anna, $stefan);
// There's no Request added from Anna - Error!
$anna->decline($friendRequest3);

// Confirmation without a previous request - Error!
$friendRequest4 = new FriendRequest($stefan, $peter);
$peter->confirm($friendRequest4);

// try to remove a friend which is not one - Error!
$peter->removeFriendship($stefan);
// remove a friend (cancel friendship on both sides!)
$peter->removeFriendship($anna);
