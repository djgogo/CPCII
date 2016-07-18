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
    private $friendRequests = [];
    /**
     * @var array
     */
    private $requestStatus = [];

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getName() : string
    {
        return $this->name;
    }

    public function addFriendRequest(FriendRequest $friendRequest)
    {
        if (in_array($friendRequest->getFrom(), $this->friendRequests)) {
            printf ("\n **> %s got already a Request from %s - Request rejected!\n", $this->name, $friendRequest->getFrom());
        } else {
            $this->friendRequests[] = $friendRequest->getFrom();
            printf("\nFriend Request from %s to %s added", $friendRequest->getFrom(), $this->name);
        }
    }

    public function confirm(FriendRequest $friendRequest)
    {
        if (in_array($friendRequest->getFrom()->getName(), $this->requestStatus)) {
            printf ("\n **> Friend Request from %s is already confirmed!\n", $friendRequest->getFrom());
        } else {
            $this->requestStatus[] = $friendRequest->getFrom()->getName();
            printf("\n%s confirmed %s's Friend Request :-)\n", $this->name , $friendRequest->getFrom());
        }
    }

    public function decline(FriendRequest $friendRequest)
    {
        if (($key = array_search($friendRequest->getFrom(), $this->friendRequests)) === false) {
            printf ("\n **> %s not found! Could not be declined!\n", $friendRequest->getFrom());
        } else {
            unset($this->friendRequests[$key]);
            printf("\nFriend Request from %s has been declined :-(\n", $friendRequest->getFrom());
        }
    }

    public function removeFriend(User $from, User $to)
    {

    }

    private function isFriend(User $user) : bool
    {
        // todo for easyer check in the other methods
    }

    public function __toString()
    {
        return $this->name;
    }
}
