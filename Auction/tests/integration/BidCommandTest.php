<?php
class BidCommandTest extends PHPUnit_Framework_TestCase
{
    /**
     * @todo Besserer Name
     */
    public function testHappyPath()
    {
        $auction = $this->getMockBuilder(Auction::class)
                        ->enableProxyingToOriginalMethods()
                        ->setConstructorArgs(
                            [
                                new User(
                                    new Nickname('Seller'),
                                    new Email('seller@example.com')
                                ),
                                'lorem ipsum',
                                new DateTimeImmutable('2016-04-19'),
                                new DateTimeImmutable('2016-04-26'),
                                new EUR(100)
                            ]
                        )
                        ->getMock();

        $auction->expects($this->once())
                ->method('addBid');

        $command = new BidCommand(
            $auction,
            new DateTimeImmutable,
            new User(
                new Nickname('Bidder'),
                new Email('bidder@example.com')
            ),
            new EUR(100)
        );

        $this->assertEquals(
            new Redirect('/'),
            $command->execute()
        );
    }
}
