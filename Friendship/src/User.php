<?php
declare(strict_types = 1);

class User
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var array
     */
    private $friends = [];

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function addFriendRequest(FriendRequest $friendRequest)
    {
        if (in_array($friendRequest->getFrom(), $this->friends)) {
            printf ("\n **> User %s is already friend of %s - No Friend Request added\n", $friendRequest->getFrom(), $this->name);
        }
        elseif ($friendRequest->getStatus() === 'pending') {
            printf ("\n **> %s got already a Request from %s - Request is pending!\n", $this->name, $friendRequest->getFrom());
        }
        elseif ($friendRequest->getStatus() === 'declined') {
            printf ("\n **> %s got already a Request from %s - Request was declined!\n", $this->name, $friendRequest->getFrom());
        } else {
            $friendRequest->setStatus('pending');
            printf("\nFriend Request from %s to %s added", $friendRequest->getFrom(), $this->name);
        }
    }

    public function confirm(FriendRequest $friendRequest)
    {
        if (in_array($friendRequest->getFrom(), $this->friends)) {
            printf ("\n **> User %s is already friend of %s - Confirmation declined!\n", $friendRequest->getFrom(), $this->name);
        }
        elseif ($friendRequest->getStatus() === ''){
            printf ("\n **> There's no Friend Request from %s - Confirmation declined!\n", $friendRequest->getFrom());
        } else {
            $this->addFriend($friendRequest->getFrom());
            $friendRequest->getFrom()->addFriend($this);
            printf("\n%s confirmed %s's Friend Request :-)\n", $this->name , $friendRequest->getFrom());
        }
    }

    public function decline(FriendRequest $friendRequest)
    {
        if ($friendRequest->getStatus() === '') {
            printf ("\n **> There's no Friend Request from %s - Could not be declined!\n", $friendRequest->getFrom());
        }
        elseif ($friendRequest->getStatus() === 'declined') {
            printf ("\n **> %s is already declined!\n", $friendRequest->getFrom());
        } else {
            $friendRequest->setStatus('declined');
            printf("\nFriend Request from %s has been declined :-(\n", $friendRequest->getFrom());
        }
    }

    public function removeFriendship(User $user)
    {
        if ($key = array_search($user, $this->friends) === false) {
            printf ("\n **> %s is not a friend of %s! Could not be removed!\n", $user, $this->name);
        } else {
            unset($this->friends[$key]);
            printf ("\n %s has been removed from %s's friends list!\n", $user, $this->name);

            // remove the opposite-Friendship Relation!
            $user->removeFriend($this);
        }
    }

    private function removeFriend(User $user)
    {
        if ($key = array_search($user, $this->friends) === false) {
            printf ("\n **> %s is not a friend of %s! Could not be removed!\n", $user, $this->name);
        } else {
            unset($this->friends[$key]);
            printf ("\n %s has been removed from %s's friends list!\n", $user, $this->name);
        }
    }

    private function addFriend(User $user)
    {
        if (in_array($user, $this->friends)) {
            printf ("\n **> %s has been added already before!\n", $user);
        } else {
            $this->friends[] = $user;
        }
    }

    public function __toString() : string
    {
        return $this->name;
    }
}
