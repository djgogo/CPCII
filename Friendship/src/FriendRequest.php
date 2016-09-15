<?php
declare(strict_types = 1);

class FriendRequest
{
    /**
     * @var User
     */
    private $from;

    /**
     * @var User
     */
    private $to;

    /**
     * @var FriendRequestState
     */
    private $state;

    public function __construct(User $from, User $to, FriendRequestState $state = null)
    {
        $this->from = $from;
        $this->to = $to;

        if ($state !== null) {
            $this->setState($state);
        }
    }

    public function getFrom() : User
    {
        return $this->from;
    }

    public function getTo() : User
    {
        return $this->to;
    }

    public function accept()
    {
        $this->setState($this->state->accept());
    }

    public function decline()
    {
        $this->setState($this->state->decline());
    }

    public function remove()
    {
        $this->setState($this->state->remove());
    }

    public function request()
    {
        $this->setState($this->state->request());
    }

    public function isPending() : bool
    {
        return $this->state instanceof PendingFriendRequestState;
    }

    public function isAccepted() : bool
    {
        return $this->state instanceof AcceptedFriendRequestState;
    }

    public function isRemoved() : bool
    {
        return $this->state instanceof RemovedFriendRequestState;
    }

    public function isDeclined() : bool
    {
        return $this->state instanceof DeclinedFriendRequestState;
    }

    public function isWithoutRequest()
    {
        if ($this->state !== null) {
            return false;
        }
        return true;
    }

    public function setState(FriendRequestState $state)
    {
        $this->state = $state;
    }

    public function getState() : string
    {
        switch (true) {
            case $this->state instanceof PendingFriendRequestState;
                return 'pending';
                break;
            case $this->state instanceof AcceptedFriendRequestState;
                return 'accepted';
                break;
            case $this->state instanceof RemovedFriendRequestState;
                return 'removed';
                break;
            case $this->state instanceof DeclinedFriendRequestState;
                return 'declined';
                break;
            default:
                throw new InvalidFriendRequestException("Status konnte nicht ermittelt werden!");
        }
    }

    public function add()
    {
        if ($this->isAccepted()) {
            throw new \InvalidFriendRequestException('User ' . $this->getFrom() . ' is already friend of ' . $this->getTo());
        } elseif ($this->isPending()) {
            throw new \InvalidFriendRequestException($this->getTo() . ' got already a Request from ' . $this->getFrom());
        } elseif ($this->isDeclined()) {
            throw new \InvalidFriendRequestException($this->getTo() . ' got already a Request from ' . $this->getFrom());
        } else {
            $this->setState(new PendingFriendRequestState);
        }
    }
}
