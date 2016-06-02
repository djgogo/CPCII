<?php
declare(strict_types=1);

class BidRouter implements PostRequestRouter
{
    private $auctionMapper;

    public function __construct(AuctionMapper $auctionMapper)
    {
        $this->auctionMapper = $auctionMapper;
    }

    public function canRoute(PostRequest $request, Session $session) : bool
    {
        return $request->getUri() == '/bid' &&
               $request->hasParameter('auction') &&
               $request->hasParameter('amount') &&
               $session->hasUser();
    }

    public function route(PostRequest $request, Session $session) : Command
    {
        return new BidCommand(
            $this->auctionMapper->findById((int) $request->getParameter('auction')),
            new DateTimeImmutable,
            $session->getUser(),
            new EUR((int) $request->getParameter('amount'))
        );
    }
}
