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
        if (in_array($friendRequest->getFrom(), $this->friends) && $friendRequest->isWithout()) {
            printf(
                "\n --> User %s is already friend of %s - No Friend Request added!\n",
                $friendRequest->getFrom(),
                $friendRequest->getTo()
            );
        } else {
            $this->add($friendRequest);
        }
    }

    private function add(FriendRequest $friendRequest)
    {
        if ($friendRequest->isAccepted()) {
            throw new \InvalidFriendRequestException(
                'User ' . $friendRequest->getFrom() . ' is already friend of ' . $friendRequest->getTo()
            );
        } elseif ($friendRequest->isPending()) {
            throw new \InvalidFriendRequestException(
                $friendRequest->getTo() . ' got already a Request from ' . $friendRequest->getFrom()
            );
        } elseif ($friendRequest->isDeclined()) {
            throw new \InvalidFriendRequestException(
                $friendRequest->getTo() . ' got already a Request from ' . $friendRequest->getFrom()
            );
        }
        $friendRequest->request();
    }

    public function confirm(FriendRequest $friendRequest)
    {
        if (in_array($friendRequest->getFrom(), $this->friends)) {
            throw new \InvalidFriendRequestException('User ' . $friendRequest->getFrom() . ' is already friend of ' . $this->name);
        } elseif ($friendRequest->isWithout()) {
            throw new \InvalidFriendRequestException('There\'s no Friend Request from ' . $friendRequest->getFrom() . ' - Confirmation declined!');
        } else {
            $this->addFriend($friendRequest->getFrom());
            $friendRequest->getFrom()->addFriend($this);
            $friendRequest->accept();
        }
    }

    public function decline(FriendRequest $friendRequest)
    {
        if ($friendRequest->isWithout()) {
            throw new \InvalidFriendRequestException('There\'s no Friend Request from ' . $friendRequest->getFrom() . ' - Confirmation declined!');
        } elseif ($friendRequest->isDeclined()) {
            throw new \InvalidFriendRequestException($friendRequest->getFrom() . ' is already declined!!');
        } else {
            $friendRequest->decline();
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
