<?php
declare(strict_types = 1);

class User
{
    /**
     * @var string
     */
    private $name;
    private $friendRequests = [];

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function addFriendRequest(FriendRequest $friendRequest)
    {
        if (!in_array($friendRequest->getFrom(), $this->friendRequests)) {
            $this->friendRequests[] = $friendRequest;
        } else {
            //printf (""); or throw new FriendRequestException('User has already a Request from User $....');
        }
    }

    public function confirm(FriendRequest $friendRequest)
    {

    }

    public function decline(FriendRequest $friendRequest)
    {

    }

    public function removeFriend(User $from, User $to)
    {

    }
}
