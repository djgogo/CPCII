<?php
declare(strict_types=1);

class Factory
{
    public function createApplication() : Application
    {
        return new Application($this, $this->createSession());
    }

    public function createGetRequestRouterChain() : GetRequestRouterChain
    {
        $chain = new GetRequestRouterChain;

        return $chain;
    }

    public function createPostRequestRouterChain() : PostRequestRouterChain
    {
        $chain = new PostRequestRouterChain;

        $chain->add($this->createBidRouter());

        return $chain;
    }

    public function createBidRouter() : BidRouter
    {
        return new BidRouter($this->createAuctionMapper());
    }

    public function createAuctionMapper() : AuctionMapper
    {
        return new AuctionMapper;
    }

    public function createSession() : Session
    {
        $session = new Session;

        $session->setUser(
            new User(
                new Nickname('Bidder'),
                new Email('bidder@example.com')
            )
        );


        return $session;
    }
}
