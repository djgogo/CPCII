<?php

namespace Address\Controllers {

    use Address\Http\Request;
    use Address\Http\Response;
    use Address\Commands\UpdateAddressFormCommand;
    use Address\Gateways\AddressTableDataGateway;
    use Address\Entities\Address;

    /**
     * @covers Address\Controllers\UpdateAddressController
     * @uses   Address\Http\Request
     * @uses   Address\Http\Response
     * @uses   Address\Commands\UpdateAddressFormCommand
     * @uses   Address\Gateways\AddressTableDataGateway
     * @uses   Address\Entities\Address
     */
    class UpdateAddressControllerTest extends \PHPUnit_Framework_TestCase
    {
        /** @var Request | \PHPUnit_Framework_MockObject_MockObject */
        private $request;

        /** @var Response | \PHPUnit_Framework_MockObject_MockObject */
        private $response;

        /** @var UpdateAddressFormCommand | \PHPUnit_Framework_MockObject_MockObject */
        private $updateAddressFormCommand;

        /** @var UpdateAddressController */
        private $updateAddressController;

        /** @var AddressTableDataGateway | \PHPUnit_Framework_MockObject_MockObject */
        private $dataGateway;

        /** @var Address | \PHPUnit_Framework_MockObject_MockObject */
        private $address;

        protected function setUp()
        {
            $this->request = $this->getMockBuilder(Request::class)->disableOriginalConstructor()->getMock();
            $this->response = $this->getMockBuilder(Response::class)->disableOriginalConstructor()->getMock();
            $this->address = $this->getMockBuilder(Address::class)->disableOriginalConstructor()->getMock();
            $this->dataGateway = $this->getMockBuilder(AddressTableDataGateway::class)->disableOriginalConstructor()->getMock();
            $this->updateAddressFormCommand = $this->getMockBuilder(UpdateAddressFormCommand::class)->disableOriginalConstructor()->getMock();

            $this->updateAddressController = new UpdateAddressController($this->updateAddressFormCommand, $this->dataGateway);
        }

        public function testControllerCanBeExecutedAndSetsRightRedirect()
        {
            $this->updateAddressFormCommand
                ->expects($this->once())
                ->method('execute')
                ->with($this->request)
                ->willReturn(true);

            $this->response
                ->expects($this->once())
                ->method('setAddresses')
                ->with(array($this->address));

            $this->dataGateway
                ->expects($this->once())
                ->method('getAllAddresses')
                ->willReturn(array($this->address));

            $this->response
                ->expects($this->once())
                ->method('setRedirect')
                ->with('/');

            $this->updateAddressController->execute($this->request, $this->response);
        }

        public function testControllerRepopulateFormFieldsAndReturnsRightTemplateOnError()
        {
            $this->updateAddressFormCommand
                ->expects($this->once())
                ->method('execute')
                ->with($this->request)
                ->willReturn(false);

            $this->response
                ->expects($this->once())
                ->method('setAddress')
                ->with($this->address);

            $this->dataGateway
                ->expects($this->once())
                ->method('findAddressById')
                ->with(1)
                ->willReturn($this->address);

            $this->request
                ->expects($this->once())
                ->method('getValue')
                ->with('id')
                ->willReturn(1);

            $this->updateAddressFormCommand
                ->expects($this->once())
                ->method('repopulateForm');

            $this->assertEquals('addresses/updateaddress.twig', $this->updateAddressController->execute($this->request, $this->response));
        }
    }
}
