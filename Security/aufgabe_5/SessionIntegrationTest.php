<?php
require 'autoload.php';

class SessionIntegrationTest extends PHPUnit_Framework_TestCase {

    /** @var Session */
    private $session;

    protected function setUp() {
        $store = new SessionStoreStub();
        $this->session = new Session($store);
    }

    public function testRequestWithoutSessionIdGeneratesNewSession() {
        $request = new HttpRequest('/');
        $this->session->init($request);
        $this->assertNotEmpty($this->session->getSessionId());
    }

}
