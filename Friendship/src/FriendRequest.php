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
}
