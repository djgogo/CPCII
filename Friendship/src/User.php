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
            throw new \InvalidFriendRequestException('User '. $friendRequest->getFrom() .' is already friend of '. $this->name);
        }
        elseif ($friendRequest->getStatus() === 'pending') {
            throw new \InvalidFriendRequestException($this->name .' got already a Request from '. $friendRequest->getFrom());
        }
        elseif ($friendRequest->getStatus() === 'declined') {
            throw new \InvalidFriendRequestException($this->name .' got already a Request from '. $friendRequest->getFrom());
        } else {
            $friendRequest->setStatus('pending');
        }
    }

    public function confirm(FriendRequest $friendRequest)
    {
        if (in_array($friendRequest->getFrom(), $this->friends)) {
            throw new \InvalidFriendRequestException('User '. $friendRequest->getFrom() .' is already friend of '. $this->name);
        }
        elseif ($friendRequest->getStatus() === ''){
            throw new \InvalidFriendRequestException('There\'s no Friend Request from '. $friendRequest->getFrom() .' - Confirmation declined!');
        } else {
            $this->addFriend($friendRequest->getFrom());
            $friendRequest->getFrom()->addFriend($this);

        }
    }

    public function decline(FriendRequest $friendRequest)
    {
        if ($friendRequest->getStatus() === '') {
            throw new \InvalidFriendRequestException('There\'s no Friend Request from '. $friendRequest->getFrom() .' - Confirmation declined!');
        }
        elseif ($friendRequest->getStatus() === 'declined') {
            throw new \InvalidFriendRequestException($friendRequest->getFrom() .' is already declined!!');
        } else {
            $friendRequest->setStatus('declined');
        }
    }

    public function removeFriendship(User $user)
    {
        if ($key = array_search($user, $this->friends) === false) {
            throw new \InvalidFriendRequestException($user .' is not a friend of '. $this->name);
        } else {
            unset($this->friends[$key]);

            // remove the opposite-Friendship Relation!
            $user->removeFriend($this);
        }
    }

    private function removeFriend(User $user)
    {
        if ($key = array_search($user, $this->friends) === false) {
            throw new \InvalidFriendRequestException($user .' is not a friend of '. $this->name);
        } else {
            unset($this->friends[$key]);
        }
    }

    private function addFriend(User $user)
    {
        if (in_array($user, $this->friends)) {
            throw new \InvalidFriendRequestException($user .' has been added already before!');
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
