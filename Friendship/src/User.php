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
        if (in_array($friendRequest->getFrom(), $this->friends) && $friendRequest->isWithoutRequest()) {
            $friendRequest->setState(new AcceptedFriendRequestState);
            printf(
                "\n --> User %s is already friend of %s - No Friend Request added!\n",
                $friendRequest->getFrom(),
                $friendRequest->getTo()
            );
        } else {
            $this->addRequest($friendRequest);
        }
    }

    private function addRequest(FriendRequest $friendRequest)
    {
        try {
            $friendRequest->add();
            printf("\nFriend Request from %s to %s added", $friendRequest->getFrom(), $friendRequest->getTo());
        } catch (InvalidFriendRequestException $e) {
            printf(
                "\n--> %s got already a Request from %s - Request is %s!\n",
                $friendRequest->getTo(),
                $friendRequest->getFrom(),
                $friendRequest->getState()
            );
        }
    }

    public function confirm(FriendRequest $friendRequest)
    {
        if (in_array($friendRequest->getFrom(), $this->friends)) {
            throw new \InvalidFriendRequestException('User ' . $friendRequest->getFrom() . ' is already friend of ' . $this->name);
        } elseif ($friendRequest->isWithoutRequest()) {
            throw new \InvalidFriendRequestException('There\'s no Friend Request from ' . $friendRequest->getFrom() . ' - Confirmation declined!');
        } else {
            $this->addFriend($friendRequest->getFrom());
            $friendRequest->getFrom()->addFriend($this);
            $friendRequest->setState(new AcceptedFriendRequestState);
        }
    }

    public function decline(FriendRequest $friendRequest)
    {
        if ($friendRequest->isWithoutRequest()) {
            throw new \InvalidFriendRequestException('There\'s no Friend Request from ' . $friendRequest->getFrom() . ' - Confirmation declined!');
        } elseif ($friendRequest->isDeclined()) {
            throw new \InvalidFriendRequestException($friendRequest->getFrom() . ' is already declined!!');
        } else {
            $friendRequest->setState(new DeclinedFriendRequestState);
        }
    }

    public function removeFriendship(User $user)
    {
        if ($key = array_search($user, $this->friends) === false) {
            throw new \InvalidFriendRequestException($user . ' is not a friend of ' . $this->name);
        } else {
            unset($this->friends[$key]);

            // remove the opposite-Friendship Relation!
            $user->removeFriend($this);
        }
    }

    private function removeFriend(User $user)
    {
        if ($key = array_search($user, $this->friends) === false) {
            throw new \InvalidFriendRequestException($user . ' is not a friend of ' . $this->name);
        } else {
            unset($this->friends[$key]);
        }
    }

    private function addFriend(User $user)
    {
        if (in_array($user, $this->friends)) {
            throw new \InvalidFriendRequestException($user . ' has been added already before!');
        } else {
            $this->friends[] = $user;
        }
    }

    public function getFriends() : array
    {
        return $this->friends;
    }

    public function __toString() : string
    {
        return $this->name;
    }
}
