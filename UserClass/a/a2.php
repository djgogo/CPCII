<?php
require_once 'a1.php';

$user1 = new User(1, 'Alice', 'alice@foo.com');
$user2 = new User(2, 'Bob', 'bob@something.com');

$user2->setScreenName('Superman');
printf ("\n * ScreenName for User 2 is set!");

printf ("\nUser: %d" . " %s %s\n", $user1->getUserId(),$user1->getScreenName(), $user1->getEmail());
printf ("User: %d" . " %s %s\n", $user2->getUserId(),$user2->getScreenName(), $user2->getEmail());

$user1->setEmail('alice.foo@bar.com');
printf ("\n * Alice's Email changed!");

printf ("\nUser: %d" . " %s %s\n", $user1->getUserId(),$user1->getScreenName(), $user1->getEmail());
printf ("User: %d" . " %s %s\n", $user2->getUserId(),$user2->getScreenName(), $user2->getEmail());
