<?php
class BidPlacementTest extends PHPUnit_Framework_TestCase
{
    /**
     * @todo Prüfen, ob Bid im Auction-Objekt angekommen ist
     * bzw. ob beim nächsten GET-Request das neue Gebot sichtbar ist bzw.
     * ob in der Datenbank das neue Gebot steht (mit DbUnit)
     * @todo Besserer Name
     */
    public function testHappyPath()
    {
        $request = new PostRequest(
            '/bid',
            [
                'auction' => '1',
                'amount'  => '100'
            ]
        );
        
        $session = new Session;

        $session->setUser(
            new User(
                new Nickname('Bidder'),
                new Email('bidder@example.com')
            )
        );

        $application = new Application(new Factory, $session);
        $response    = new Response;

        $application->run($request, $response, false);

        $this->assertEquals(
            "You will be redirected to /\n",
            $response->getBody()
        );

        $this->assertContains(
            'Location: /',
            $response->getHeaders()
        );
    }
}
