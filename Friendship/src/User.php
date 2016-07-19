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
        if ($friendRequest->getStatus() === 'pending' || $friendRequest->getStatus() === 'accepted') {
            printf ("\n **> %s got already a Request from %s - Request rejected!\n", $this->name, $friendRequest->getFrom());
        } elseif ($friendRequest->getStatus() === 'declined') {
            printf ("\n **> %s got already a Request from %s - Request was declined!\n", $this->name, $friendRequest->getFrom());
        } else {
            $friendRequest->setStatus('pending');
            printf("\nFriend Request from %s to %s added", $friendRequest->getFrom(), $this->name);
        }
    }

    public function confirm(FriendRequest $friendRequest)
    {
        if ($friendRequest->getStatus() === ''){
            printf ("\n **> There's no Friend Request from %s - Confirmation declined!\n", $friendRequest->getFrom());
        }
        elseif ($friendRequest->getStatus() === 'confirmed') {
            printf ("\n **> Friend Request from %s is already confirmed!\n", $friendRequest->getFrom());
        } else {
            $this->addFriend($friendRequest->getFrom());
            $friendRequest->getFrom()->addFriend($this);
            $friendRequest->setStatus('accepted');
            printf("\n%s confirmed %s's Friend Request :-)\n", $this->name , $friendRequest->getFrom());
        }
    }

    public function decline(FriendRequest $friendRequest)
    {
        if ($friendRequest->getStatus() === '') {
            printf ("\n **> %s not found! Could not be declined!\n", $friendRequest->getFrom());
        } elseif ($friendRequest->getStatus() === 'declined') {
            printf ("\n **> %s is already declined!\n", $friendRequest->getFrom());
        } else {
            $friendRequest->setStatus('declined');
            printf("\nFriend Request from %s has been declined :-(\n", $friendRequest->getFrom());
        }
    }

    public function removeFriend(User $user)
    {
        if (($key = array_search($user, $this->friends)) === false) {
            printf ("\n **> %s is not a friend! Could not be removed!\n", $user);
        } else {
            unset($this->friends[$key]);
            printf ("\n %s has been removed from $this->name's friends list!\n", $user);
        }
    }

    public function addFriend(User $user)
    {
        if (!in_array($user, $this->friends)) {
            $this->friends[] = $user;
        }
    }

    public function __toString() : string
    {
        return $this->name;
    }
}
