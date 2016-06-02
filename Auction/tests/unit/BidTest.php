<?php
declare(strict_types=1);

class BidTest extends PHPUnit_Framework_TestCase
{
    private $date;
    private $bidder;
    private $amount;
    private $bid;

    protected function setUp()
    {
        $this->date   = new DateTimeImmutable('2016-04-18');
        $this->bidder = new User(new Nickname('Bidder'), new Email('bidder@example.com'));
        $this->amount = new EUR(500);

        $this->bid = new Bid(
            $this->date,
            $this->bidder,
            $this->amount
        );
    }

    public function testHasDate()
    {
        $this->assertEquals($this->date, $this->bid->getDate());
    }

    public function testHasUser()
    {
        $this->assertEquals($this->bidder, $this->bid->getUser());
    }

    public function testHasAmount()
    {
        $this->assertEquals($this->amount, $this->bid->getAmount());
    }
}
