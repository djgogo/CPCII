<?php

namespace Address\Controllers {

    use Address\Commands\RegistrationFormCommand;
    use Address\Entities\Address;
    use Address\Gateways\AddressTableDataGateway;
    use Address\Http\Request;
    use Address\Http\Response;

    /**
     * @covers Address\Controllers\RegisterController
     * @uses Address\Http\Request
     * @uses Address\Http\Response
     * @uses Address\Gateways\AddressTableDataGateway
     * @uses Address\Entities\Address
     * @uses Address\Commands\RegistrationFormCommand
     */
    class RegisterControllerTest extends \PHPUnit_Framework_TestCase
    {
        /** @var Request | \PHPUnit_Framework_MockObject_MockObject */
        private $request;

        /** @var Response | \PHPUnit_Framework_MockObject_MockObject */
        private $response;

        /** @var AddressTableDataGateway | \PHPUnit_Framework_MockObject_MockObject */
        private $dataGateway;

        /** @var RegistrationFormCommand | \PHPUnit_Framework_MockObject_MockObject */
        private $registrationFormCommand;

        /** @var Address | \PHPUnit_Framework_MockObject_MockObject */
        private $address;

        /** @var RegisterController */
        private $registerController;

        protected function setUp()
        {
            $this->request = $this->getMockBuilder(Request::class)->disableOriginalConstructor()->getMock();
            $this->response = $this->getMockBuilder(Response::class)->disableOriginalConstructor()->getMock();
            $this->dataGateway = $this->getMockBuilder(AddressTableDataGateway::class)->disableOriginalConstructor()->getMock();
            $this->registrationFormCommand = $this->getMockBuilder(RegistrationFormCommand::class)->disableOriginalConstructor()->getMock();
            $this->address = $this->getMockBuilder(Address::class)->disableOriginalConstructor()->getMock();

            $this->registerController = new RegisterController($this->registrationFormCommand, $this->dataGateway);
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
                ->method('setAddresses')
                ->with(...[$this->address]);

            $this->dataGateway
                ->expects($this->once())
                ->method('getAllAddresses')
                ->willReturn([$this->address]);

            $this->assertEquals('home.twig', $this->registerController->execute($this->request, $this->response));
        }

        public function testControllerReturnsRightTemplateIfExecutionFails()
        {
            $this->registrationFormCommand
                ->expects($this->once())
                ->method('execute')
                ->with($this->request)
                ->willReturn(false);

            $this->assertEquals('authentication/register.twig', $this->registerController->execute($this->request, $this->response));
        }
    }
}
