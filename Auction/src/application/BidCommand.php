<?php
declare(strict_types=1);

class BidCommand implements Command
{
    private $auction;
    private $date;
    private $user;
    private $amount;

    public function __construct(Auction $auction, DateTimeImmutable $date, User $user, EUR $amount)
    {
        $this->auction = $auction;
        $this->date    = $date;
        $this->user    = $user;
        $this->amount  = $amount;
    }

    public function execute() : Redirect
    {
        $bid = new Bid(
            $this->date,
            $this->user,
            $this->amount
        );

        $this->auction->addBid($bid);

        return new Redirect('/');
    }
}
