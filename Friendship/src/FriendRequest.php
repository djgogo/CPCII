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
     * @var string
     */
    private $status = '';

    public function __construct(User $from, User $to)
    {
        $this->from = $from;
        $this->to = $to;
    }

    public function getFrom() : User
    {
        return $this->from;
    }

    public function getTo() : User
    {
        return $this->to;
    }

    /**
     * pending
     * accepted
     * declined
     * removed
     */
    public function setStatus(string $status)
    {
        $this->status = $status;
    }

    public function getStatus() : string
    {
        return $this->status;
    }

    public function add()
    {
        if ($this->getStatus() === 'accepted') {
            throw new \InvalidFriendRequestException('User '. $this->getFrom() .' is already friend of '. $this->getTo());
        }
        elseif ($this->getStatus() === 'pending') {
            throw new \InvalidFriendRequestException($this->getTo() .' got already a Request from '. $this->getFrom());
        }
        elseif ($this->getStatus() === 'declined') {
            throw new \InvalidFriendRequestException($this->getTo() .' got already a Request from '. $this->getFrom());
        } else {
            $this->setStatus('pending');
        }
    }
}
