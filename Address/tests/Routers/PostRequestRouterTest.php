<?php

namespace Address\Routers {

    use Address\Controllers\Error500Controller;
    use Address\Factories\Factory;
    use Address\Http\Request;
    use Address\Http\Session;
    use Address\Loggers\ErrorLogger;

    /**
     * @covers  Address\Routers\PostRequestRouter
     * @uses    Address\Factories\Factory
     * @uses    Address\Http\Session
     * @uses    Address\Http\Request
     * @uses    Address\Loggers\ErrorLogger
     */
    class PostRequestRouterTest extends \PHPUnit_Framework_TestCase
    {
        /** @var Factory | \PHPUnit_Framework_MockObject_MockObject */
        private $factory;

        /** @var Session | \PHPUnit_Framework_MockObject_MockObject */
        private $session;

        /** @var PostRequestRouter */
        private $postRequestRouter;

        /** @var ErrorLogger | \PHPUnit_Framework_MockObject_MockObject */
        private $errorLogger;

        protected function setUp()
        {
            $this->factory = $this->getMockBuilder(Factory::class)->disableOriginalConstructor()->getMock();
            $this->session = $this->getMockBuilder(Session::class)->disableOriginalConstructor()->getMock();
            $this->errorLogger = $this->getMockBuilder(ErrorLogger::class)->disableOriginalConstructor()->getMock();
            $this->postRequestRouter = new PostRequestRouter($this->factory, $this->session, $this->errorLogger);
        }

        /**
         * @dataProvider provideData
         * @param $path
         * @param $instance
         */
        public function testHappyPath($path, $instance)
        {
            $request = new Request(
                ['csrf' => '1234567890'],
                ['REQUEST_URI' => $path, 'REQUEST_METHOD' => 'POST']
            );

            $this->session
                ->expects($this->once())
                ->method('getValue')
                ->with('token')
                ->willReturn('1234567890');

            $this->assertInstanceOf($instance, $this->postRequestRouter->route($request));
        }

        public function provideData()
        {
            return [
                ['/updateaddress', \Address\Controllers\UpdateAddressController::class],
            ];
        }

        public function testRouterReturnsNullIfRequestIsNotAPostRequest()
        {
            $request = new Request(
                ['csrf' => '1234567890'],
                ['REQUEST_URI' => '/Address', 'REQUEST_METHOD' => 'GET']
            );

            $this->assertEquals(null, $this->postRequestRouter->route($request));
        }

        public function testInvalidCsrfTokenReturnsError500Controller()
        {
            $request = new Request(
                ['csrf' => 'session hi-jackers token'],
                ['REQUEST_URI' => '/Address', 'REQUEST_METHOD' => 'POST']
            );

            $this->assertInstanceOf(Error500Controller::class, $this->postRequestRouter->route($request));
        }

        public function testRouterReturnsNullIfInvalidRequestUri()
        {
            $request = new Request(
                ['csrf' => '1234567890'],
                ['REQUEST_URI' => '/invalid', 'REQUEST_METHOD' => 'POST']
            );

            $this->session
                ->expects($this->once())
                ->method('getValue')
                ->with('token')
                ->willReturn('1234567890');

            $this->assertEquals(null, $this->postRequestRouter->route($request));
        }
    }
}
