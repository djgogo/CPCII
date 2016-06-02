<?php
declare(strict_types=1);

class Bid
{
    private $date;
    private $user;
    private $amount;

    public function __construct(DateTimeImmutable $date, User $user, EUR $amount)
    {
        $this->date   = $date;
        $this->user   = $user;
        $this->amount = $amount;
    }

    public function getDate() : DateTimeImmutable
    {
        return $this->date;
    }

    public function getUser() : User
    {
        return $this->user;
    }

    public function getAmount() : EUR
    {
        return $this->amount;
    }
}
