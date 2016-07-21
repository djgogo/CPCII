<?php
declare(strict_types = 1);
require_once __DIR__ . '/bootstrap.php';

$peter = new User('Peter');
$anna = new User('Anna');
$stefan = new User('Stefan');

/**
 * Happy Path - add Friend Request
 */
// Friend Request from Anna to Peter
$friendRequest1 = new FriendRequest($anna, $peter);
try {
    $peter->addFriendRequest($friendRequest1);
    printf("\nFriend Request from %s to %s added", $friendRequest1->getFrom(), $peter);
} catch (InvalidFriendRequestException $e) {
    printf("\nFriend Request from Anna to Peter could not be added!");
}

/**
 * Trying to add a Request which was previous alreaedy added - Error!
 */
try {
    $peter->addFriendRequest($friendRequest1);
    printf("\nFriend Request from %s to %s added", $friendRequest1->getFrom(), $peter);
} catch (InvalidFriendRequestException $e) {
    printf ("\n **> %s got already a Request from %s - Request is pending!\n", $peter, $friendRequest1->getFrom());
}

/**
 * Happy Path - Confirmation of a Request
 */
// Peter confirms Anna's Request
try {
    $peter->confirm($friendRequest1);
    printf("\n%s confirmed %s's Friend Request :-)\n", $peter, $friendRequest1->getFrom());
} catch (InvalidFriendRequestException $e) {
    printf ("\n **> Anna's Friend Request could not be confirmed!");
}

/**
 * Trying to confirm a Request again - Error!
 */
try {
    $peter->confirm($friendRequest1);
} catch (InvalidFriendRequestException $e) {
    printf ("\n **> User %s is already friend of %s - Confirmation declined!\n", $friendRequest1->getFrom(), $peter);
}

/**
 * Trying to add a vice versa Friend Request which was already added before with the Request from Anna to Peter
 */
// Friend Request from Peter to Anna
$friendRequest2 = new FriendRequest($peter, $anna);
// Peter is already Friend of Anna - Error!
try {
    $anna->addFriendRequest($friendRequest2);
} catch (InvalidFriendRequestException $e) {
    printf ("\n **> User %s is already friend of %s - No Friend Request added\n", $friendRequest2->getFrom(), $anna);
}

/**
 * Trying to decline a non existing Friend Request from Anna. Error!
 */
// Friend Request from Anna to Stefan
$friendRequest3 = new FriendRequest($anna, $stefan);
try {
    $anna->decline($friendRequest3);
} catch (InvalidFriendRequestException $e) {
    printf ("\n **> There's no Friend Request from %s - Could not be declined!\n", $friendRequest3->getFrom());
}

/**
 * Trying to confirm a Request without Friend Request added before - Error!
 */
// Friend Request from Stefan to Peter
$friendRequest4 = new FriendRequest($stefan, $peter);
try {
    $peter->confirm($friendRequest4);
} catch (InvalidFriendRequestException $e) {
    printf ("\n **> There's no Friend Request from %s - Confirmation declined!\n", $friendRequest4->getFrom());
}

/**
 * Trying to remove a friend which is not one - Error!
 */
try {
    $peter->removeFriendship($stefan);
} catch (InvalidFriendRequestException $e) {
    printf ("\n **> %s is not a friend of %s! Could not be removed!\n", $stefan, $peter);
}

/**
 * Happy Path. Remove a Friend and cancel Friendship on both sides!
 */
try {
    $peter->removeFriendship($anna);
    printf ("\n%s has been removed from %s's friends list!\n", $anna, $peter);
    printf ("%s has been removed from %s's friends list!\n", $peter, $anna);
} catch (InvalidFriendRequestException $e) {
    printf ("\n Removing Friendship with Anna failed!");
}

/**
 * Trying to decline a Friend Request from Anna again - Error!
 */
// Add Friend Request from Anna to Stefan
try {
    $stefan->addFriendRequest($friendRequest3);
    printf("\nFriend Request from %s to %s added", $friendRequest1->getFrom(), $peter);
} catch (InvalidFriendRequestException $e) {
    printf ("\n Could not add Anna's Request!");
}
// Decline Friend Request from Anna
try {
    $stefan->decline($friendRequest3);
    printf("\nFriend Request from %s has been declined :-(\n", $friendRequest3->getFrom());
} catch (InvalidFriendRequestException $e) {
    printf ("\n Could not decline Anna's Request!");
}
// Try to Decline Friend Request from Anna again!
try {
    $stefan->decline($friendRequest3);
} catch (InvalidFriendRequestException $e) {
    printf ("\n **> %s's Friend Request is already declined - Cannot be declined again!\n", $friendRequest3->getFrom());
}

/**
 * Trying to add a Request which was previous declined - Error!
 */
try {
    $stefan->addFriendRequest($friendRequest3);
    printf("\nFriend Request from %s to %s added", $friendRequest3->getFrom(), $stefan);
} catch (InvalidFriendRequestException $e) {
    printf ("\n **> %s got already a Request from %s - Request was declined!\n", $stefan, $friendRequest3->getFrom());
}




