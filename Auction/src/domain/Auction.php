<?php
declare(strict_types=1);

class Auction
{
    private $seller;
    private $description;
    private $startDate;
    private $endDate;
    private $initialPrice;
    private $bids = [];

    public function __construct(User $seller, string $description, \DateTimeImmutable $startDate, \DateTimeImmutable $endDate, EUR $initialPrice)
    {
        $this->ensureStartDateBeforeEndDate($startDate, $endDate);

        $this->seller       = $seller;
        $this->description  = $description;
        $this->startDate    = $startDate;
        $this->endDate      = $endDate;
        $this->initialPrice = $initialPrice;
    }

    public function addBid(Bid $bid)
    {
        $this->ensureBidderIsNotSeller($bid->getUser());
        $this->ensureBidMeetsInitialPrice($bid->getAmount());
        $this->ensureBidNotTooLow($bid->getAmount());

        $this->bids[] = $bid;
    }

    public function getBids() : array
    {
        return $this->bids;
    }

    public function getSeller() : User
    {
        return $this->seller;
    }

    public function getDescription() : string
    {
        return $this->description;
    }

    public function getStartDate() : DateTimeImmutable
    {
        return $this->startDate;
    }

    public function getEndDate() : DateTimeImmutable
    {
        return $this->endDate;
    }

    public function getInitialPrice() : EUR
    {
        return $this->initialPrice;
    }

    private function ensureStartDateBeforeEndDate(DateTimeImmutable $startDate, DateTimeImmutable $endDate)
    {
        if ($endDate < $startDate) {
            throw new EndDateBeforeStartDateException;
        }
    }

    private function ensureBidderIsNotSeller(User $bidder)
    {
        if ($this->seller == $bidder) {
            throw new IllegalBidderException;
        }
    }

    private function ensureBidMeetsInitialPrice(EUR $amount)
    {
        if (!empty($this->bids)) {
            return;
        }

        if ($amount->lessThan($this->initialPrice)) {
            throw new BidBelowInitialPriceException;
        }
    }

    private function ensureBidNotTooLow(EUR $amount)
    {
        if (empty($this->bids)) {
            return;
        }

        if ($amount->lessThan($this->getHighestBid()->getAmount()->plus(new EUR(100)))) {
            throw new BidTooLowException;
        }
    }

    private function getHighestBid() : Bid
    {
        return $this->bids[count($this->bids) - 1];
    }
}
