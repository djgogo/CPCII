<?php

namespace Suxx\Controllers {

    use Suxx\Http\Request;
    use Suxx\Http\Response;
    use Suxx\Commands\RegistrationFormCommand;
    use Suxx\Gateways\ProductTableDataGateway;

    /**
     * @covers Suxx\Controllers\RegisterController
     * @uses   Suxx\Http\Request
     * @uses   Suxx\Http\Response
     * @uses   Suxx\Commands\RegistrationFormCommand
     * @uses   Suxx\Gateways\ProductTableDataGateway
     */
    class RegisterControllerTest extends \PHPUnit_Framework_TestCase
    {
        /**
         * @var \PHPUnit_Framework_MockObject_MockObject | Request
         */
        private $request;

        /**
         * @var \PHPUnit_Framework_MockObject_MockObject | Response
         */
        private $response;

        /**
         * @var \PHPUnit_Framework_MockObject_MockObject | RegistrationFormCommand
         */
        private $registrationFormCommand;

        /**
         * @var RegisterController
         */
        private $registerController;

        /**
         * @var \PHPUnit_Framework_MockObject_MockObject | ProductTableDataGateway
         */
        private $productDataGateway;


        protected function setUp()
        {
            $this->request = $this->getMockBuilder(Request::class)->disableOriginalConstructor()->getMock();
            $this->response = $this->getMockBuilder(Response::class)->disableOriginalConstructor()->getMock();
            $this->productDataGateway = $this->getMockBuilder(ProductTableDataGateway::class)->disableOriginalConstructor()->getMock();
            $this->registrationFormCommand = $this->getMockBuilder(RegistrationFormCommand::class)->disableOriginalConstructor()->getMock();

            $this->registerController = new RegisterController($this->registrationFormCommand, $this->productDataGateway);
        }

        public function testControllerCanBeExecutedAndReturnsRightTemplate()
        {
            $this->registrationFormCommand
                ->expects($this->once())
                ->method('execute')
                ->with($this->request)
                ->willReturn(true);

            $this->response
                ->expects($this->once())
                ->method('setProducts')
                ->with(array());

            $this->productDataGateway
                ->expects($this->once())
                ->method('getAllProducts')
                ->willReturn(array());

            $this->assertEquals('base.twig', $this->registerController->execute($this->request, $this->response));
        }

        public function testControllerReturnsRightTemplateOnError()
        {
            $this->registrationFormCommand
                ->expects($this->once())
                ->method('execute')
                ->with($this->request)
                ->willReturn(false);

            $this->assertEquals('register.twig', $this->registerController->execute($this->request, $this->response));
        }
    }
}
