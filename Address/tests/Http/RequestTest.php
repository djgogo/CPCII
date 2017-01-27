<?php

namespace Address\Http {

    use Address\Exceptions\RequestValueNotFoundException;

    /**
     * @covers Address\Http\Request
     */
    class RequestTest extends \PHPUnit_Framework_TestCase
    {
        /** @var array */
        private $input;

        /** @var array */
        private $server;

        /** @var Request */
        private $request;

        protected function setUp()
        {
            $this->input = [
                'id' => '10'
            ];

            $this->server = [
                'REQUEST_URI' => '/updateaddressview?id=10',
                'REQUEST_METHOD' => 'GET',
                'PHP_AUTH_USER' => 'nginx'
            ];

            $this->request = new Request($this->input, $this->server);
        }

        public function testRequestUriCanBeRetrieved()
        {
            $this->assertEquals($this->server['REQUEST_URI'], $this->request->getRequestUri());
        }

        public function testRequestMethodCanBeRetrieved()
        {
            $this->assertEquals($this->server['REQUEST_METHOD'], $this->request->getRequestMethod());
        }

        public function testIsPostRequestReturnsRightBoolean()
        {
            $this->assertFalse($this->request->isPostRequest());
        }

        public function testIsGetRequestReturnsRightBoolean()
        {
            $this->assertTrue($this->request->isGetRequest());
        }

        public function testHttpAuthUserCanBeCheckedIfLoggedIn()
        {
            $this->assertTrue($this->request->isLoggedIn());
        }

        public function testValueCanBeRetrieved()
        {
            $this->assertEquals('10', $this->request->getValue('id'));
        }

        public function testIfValueNotFoundThrowsException()
        {
            $this->expectException(RequestValueNotFoundException::class);
            $this->assertEquals('', $this->request->getValue('Wrong Key'));
        }
    }
}
