<?php

namespace Address\Routers {

    use Address\Controllers\Error500Controller;
    use Address\Factories\Factory;
    use Address\Http\Request;
    use Address\Http\Session;
    use Address\Loggers\ErrorLogger;

    /**
     * @covers  Address\Routers\AuthenticationRouter
     * @uses    Address\Factories\Factory
     * @uses    Address\Http\Session
     * @uses    Address\Http\Request
     * @uses    Address\Loggers\ErrorLogger
     */
    class AuthenticationRouterTest extends \PHPUnit_Framework_TestCase
    {
        /** @var Factory | \PHPUnit_Framework_MockObject_MockObject */
        private $factory;

        /** @var Session | \PHPUnit_Framework_MockObject_MockObject */
        private $session;

        /** @var AuthenticationRouter */
        private $authenticationRouter;

        /** @var ErrorLogger | \PHPUnit_Framework_MockObject_MockObject */
        private $errorLogger;

        protected function setUp()
        {
            $this->factory = $this->getMockBuilder(Factory::class)->disableOriginalConstructor()->getMock();
            $this->session = $this->getMockBuilder(Session::class)->disableOriginalConstructor()->getMock();
            $this->errorLogger = $this->getMockBuilder(ErrorLogger::class)->disableOriginalConstructor()->getMock();
            $this->authenticationRouter = new AuthenticationRouter($this->factory, $this->session, $this->errorLogger);
        }

        /**
         * @dataProvider provideData
         * @param string $path
         * @param string $instance
         */
        public function testHappyPath(string $path, string $instance)
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

            $this->assertInstanceOf($instance, $this->authenticationRouter->route($request));
        }

        public function provideData(): array
        {
            return [
                ['/login', \Address\Controllers\LoginController::class],
                ['/register', \Address\Controllers\RegisterController::class],
            ];
        }

        public function testRouterReturnsNullIfRequestIsNotPostRequest()
        {
            $request = new Request(
                ['csrf' => '1234567890'],
                ['REQUEST_URI' => '/Address', 'REQUEST_METHOD' => 'GET']
            );

            $this->assertEquals(null, $this->authenticationRouter->route($request));
        }

        public function testInvalidCsrfTokenReturnsError500Controller()
        {
            $request = new Request(
                ['csrf' => 'session hi-jackers token'],
                ['REQUEST_URI' => '/Address', 'REQUEST_METHOD' => 'POST']
            );

            $this->assertInstanceOf(Error500Controller::class, $this->authenticationRouter->route($request));
        }

        public function testRouterReturnsNullOnInvalidRequestUri()
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

            $this->assertEquals(null, $this->authenticationRouter->route($request));
        }
    }
}
