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

    public function __construct(User $from, User $to)
    {
        $this->from = $from;
        $this->to = $to;
        $this->setState(new WithoutFriendRequestState());

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

    public function delete()
    {
        $this->setState($this->state->delete());
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

    public function isWithout()
    {
        return $this->state instanceof WithoutFriendRequestState;
    }

    private function setState(FriendRequestState $state)
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
}
