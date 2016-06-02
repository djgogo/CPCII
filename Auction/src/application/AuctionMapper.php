<?php
declare(strict_types=1);

class AuctionMapper
{
    public function findById(int $id) : Auction
    {
        return new Auction(
            new User(new Nickname('Seller'), new Email('seller@example.com')),
            'lorem ipsum',
            new DateTimeImmutable('2016-04-19'),
            new DateTimeImmutable('2016-04-26'),
            new EUR(100)
        );
    }
}
