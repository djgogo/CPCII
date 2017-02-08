<?php

namespace Address\Routers {

    use Address\Controllers\Error404Controller;
    use Address\Factories\Factory;
    use Address\Http\Request;

    /**
     * @covers  Address\Routers\Error404Router
     * @uses    Address\Factories\Factory
     * @uses    Address\Http\Request
     */
    class Error404RouterTest extends \PHPUnit_Framework_TestCase
    {
        /** @var Factory | \PHPUnit_Framework_MockObject_MockObject */
        private $factory;

        /** @var Error404Router */
        private $error404Router;

        protected function setUp()
        {
            $this->factory = $this->getMockBuilder(Factory::class)->disableOriginalConstructor()->getMock();
            $this->error404Router = new Error404Router($this->factory);
        }

        public function testErrorRouterReturnsRightController()
        {
            $request = new Request(
                ['csrf' => '1234567890'],
                ['REQUEST_URI' => '/invalidUri', 'REQUEST_METHOD' => 'GET']
            );

            $this->assertInstanceOf(Error404Controller::class, $this->error404Router->route($request));
        }
    }
}
