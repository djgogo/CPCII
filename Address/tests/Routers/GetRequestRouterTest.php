<?php

namespace Address\Routers {

    use Address\Factories\Factory;
    use Address\Http\Request;

    /**
     * @covers  Address\Routers\GetRequestRouter
     * @uses    Address\Factories\Factory
     * @uses    Address\Http\Request
     */
    class GetRequestRouterTest extends \PHPUnit_Framework_TestCase
    {
        /** @var Factory | \PHPUnit_Framework_MockObject_MockObject */
        private $factory;

        /** @var GetRequestRouter */
        private $getRequestRouter;

        protected function setUp()
        {
            $this->factory = $this->getMockBuilder(Factory::class)->disableOriginalConstructor()->getMock();
            $this->getRequestRouter = new GetRequestRouter($this->factory);
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
                ['REQUEST_URI' => $path, 'REQUEST_METHOD' => 'GET']
            );

            $this->assertInstanceOf($instance, $this->getRequestRouter->route($request));
        }

        public function provideData(): array
        {
            return [
                ['/', \Address\Controllers\HomeController::class],
                ['/about', \Address\Controllers\AboutController::class],
                ['/updateaddressview', \Address\Controllers\UpdateAddressViewController::class],
                ['/deleteaddress', \Address\Controllers\DeleteAddressController::class],
                ['/loginview', \Address\Controllers\LoginViewController::class],
                ['/registerview', \Address\Controllers\RegisterViewController::class],
                ['/logout', \Address\Controllers\LogoutController::class],
            ];
        }

        public function testRouterReturnsNullIfRequestIsNotGetRequest()
        {
            $request = new Request(
                ['csrf' => '1234567890'],
                ['REQUEST_URI' => '/Address', 'REQUEST_METHOD' => 'POST']
            );

            $this->assertEquals(null, $this->getRequestRouter->route($request));
        }

        public function testRouterReturnsNullIfInvalidRequestUri()
        {
            $request = new Request(
                ['csrf' => '1234567890'],
                ['REQUEST_URI' => '/invalid', 'REQUEST_METHOD' => 'GET']
            );

            $this->assertEquals(null, $this->getRequestRouter->route($request));
        }
    }
}
