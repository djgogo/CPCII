<?php

namespace Address\Controllers {

    use Address\Entities\Address;
    use Address\Exceptions\AddressTableGatewayException;
    use Address\Gateways\AddressTableDataGateway;
    use Address\Http\Request;
    use Address\Http\Response;
    use Address\Http\Session;

    /**
     * @covers Address\Controllers\DeleteAddressController
     * @uses Address\Gateways\AddressTableDataGateway
     * @uses Address\Http\Request
     * @uses Address\Http\Response
     * @uses Address\Http\Session
     * @uses Address\Entities\Address
     */
    class DeleteAddressControllerTest extends \PHPUnit_Framework_TestCase
    {
        /** @var Request | \PHPUnit_Framework_MockObject_MockObject */
        private $request;

        /** @var Response | \PHPUnit_Framework_MockObject_MockObject */
        private $response;

        /** @var Session | \PHPUnit_Framework_MockObject_MockObject */
        private $session;

        /** @var AddressTableDataGateway | \PHPUnit_Framework_MockObject_MockObject */
        private $dataGateway;

        /** @var Address */
        private $address;

        /** @var DeleteAddressController */
        private $deleteAddressController;

        protected function setUp()
        {
            $this->request = $this->getMockBuilder(Request::class)->disableOriginalConstructor()->getMock();
            $this->response = $this->getMockBuilder(Response::class)->disableOriginalConstructor()->getMock();
            $this->session = $this->getMockBuilder(Session::class)->disableOriginalConstructor()->getMock();
            $this->dataGateway = $this->getMockBuilder(AddressTableDataGateway::class)->disableOriginalConstructor()->getMock();
            $this->address = $this->getMockBuilder(Address::class)->disableOriginalConstructor()->getMock();

            $this->deleteAddressController = new DeleteAddressController($this->session, $this->dataGateway);
        }

        public function testAddressCanBeDeletedAndControllerSetsRightRedirect()
        {
            $this->dataGateway
                ->expects($this->once())
                ->method('delete')
                ->with(1)
                ->willReturn(true);

            $this->request
                ->expects($this->once())
                ->method('getValue')
                ->with('id')
                ->willReturn(1);

            $this->session
                ->expects($this->once())
                ->method('setValue')
                ->with('message', 'Datensatz wurde gelöscht');

            $this->response
                ->expects($this->once())
                ->method('setAddresses')
                ->with(...[$this->address]);

            $this->dataGateway
                ->expects($this->once())
                ->method('getAllAddresses')
                ->willReturn([$this->address]);

            $this->response
                ->expects($this->once())
                ->method('setRedirect')
                ->with('/');

            $this->deleteAddressController->execute($this->request, $this->response);
        }

        public function testAddressDeletionFailsAndControllerSetsRightRedirect()
        {
            $this->dataGateway
                ->expects($this->once())
                ->method('delete')
                ->willThrowException(new AddressTableGatewayException);

            $this->session
                ->expects($this->once())
                ->method('setValue')
                ->with('warning', 'Löschen des Datensatzes fehlgeschlagen!');

            $this->response
                ->expects($this->once())
                ->method('setAddresses')
                ->with(...[$this->address]);

            $this->dataGateway
                ->expects($this->once())
                ->method('getAllAddresses')
                ->willReturn([$this->address]);

            $this->response
                ->expects($this->once())
                ->method('setRedirect')
                ->with('/');

            $this->deleteAddressController->execute($this->request, $this->response);
        }
    }
}
