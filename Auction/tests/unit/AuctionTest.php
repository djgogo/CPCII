<?php
declare(strict_types=1);

class AuctionTest extends PHPUnit_Framework_TestCase
{
    private $auction;
    private $seller;
    private $description;
    private $startDate;
    private $endDate;
    private $initialPrice;

    protected function setUp()
    {
        $this->seller       = new User(new Nickname('Seller'), new Email('admin@example.com'));
        $this->description  = 'lorem ipsum';
        $this->startDate    = new DateTimeImmutable('2016-04-18');
        $this->endDate      = new DateTimeImmutable('2016-04-25');
        $this->initialPrice = new EUR(100);

        $this->auction = new Auction(
            $this->seller,
            $this->description,
            $this->startDate,
            $this->endDate,
            $this->initialPrice
        );
    }

    public function testHasSeller()
    {
        $this->assertEquals(
            $this->seller,
            $this->auction->getSeller()
        );
    }

    public function testHasDescription()
    {
        $this->assertEquals(
            $this->description,
            $this->auction->getDescription()
        );
    }

    public function testStartDate()
    {
        $this->assertEquals(
            $this->startDate,
            $this->auction->getStartDate()
        );
    }

    public function testEndDate()
    {
        $this->assertEquals(
            $this->endDate,
            $this->auction->getEndDate()
        );
    }

    public function testHasInitialPrice()
    {
        $this->assertEquals(
            $this->initialPrice,
            $this->auction->getInitialPrice()
        );
    }

    public function testCannotHaveEndDateBeforeStartDate()
    {
        $this->expectException(EndDateBeforeStartDateException::class);

        $this->auction = new Auction(
            $this->seller,
            $this->description,
            new DateTimeImmutable('2016-04-19'),
            new DateTimeImmutable('2016-04-18'),
            $this->initialPrice
        );
    }

    public function testUserOtherThanTheSellerCanBidOnAnAuction()
    {
        $bid = new Bid(
            new DateTimeImmutable('2016-04-19'),
            new User(new Nickname('Buyer'), new Email('buyer@example.com')),
            new EUR(100)
        );

        $this->auction->addBid($bid);

        $this->assertEquals([$bid], $this->auction->getBids());

        return $this->auction;
    }

    public function testSellerCannotBidOnOwnAuction()
    {
        $bid = new Bid(
            new DateTimeImmutable('2016-04-19'),
            $this->seller,
            new EUR(100)
        );

        $this->expectException(IllegalBidderException::class);

        $this->auction->addBid($bid);
    }

    public function testDoesNotAcceptBidsBeforeStartDate()
    {
        $this->markTestIncomplete();
    }

    public function testDoesNotAcceptBidsAfterEndDate()
    {
        $this->markTestIncomplete();
    }

    public function testFirstBidMustBeAtLeastTheInitialPrice()
    {
        $this->expectException(BidBelowInitialPriceException::class);

        $this->auction->addBid(
            new Bid(
                new DateTimeImmutable('2016-04-19'),
                new User(new Nickname('Buyer'), new Email('buyer@example.com')),
                new EUR(99)
            )
        );
    }

    /**
     * @depends testUserOtherThanTheSellerCanBidOnAnAuction
     *
     * @todo Find better name
     */
    public function testNewBidMustBeAtLeastOneEurHigherThanHighestBid(Auction $auction)
    {
        $this->expectException(BidTooLowException::class);

        $auction->addBid(
            new Bid(
                new DateTimeImmutable('2016-04-20'),
                new User(new Nickname('Buyer2'), new Email('buyer2@example.com')),
                new EUR(100)
            )
        );
    }

    /**
     * @depends testUserOtherThanTheSellerCanBidOnAnAuction
     *
     * @todo Find better name
     */
    public function testNewBidMustBeAtLeastOneEurHigherThanHighestBid2(Auction $auction)
    {
        $bid = new Bid(
            new DateTimeImmutable('2016-04-20'),
            new User(new Nickname('Buyer2'), new Email('buyer2@example.com')),
            new EUR(200)
        );

        $auction->addBid($bid);

        $this->assertCount(2, $auction->getBids());
        $this->assertContains($bid, $auction->getBids());
    }
}
