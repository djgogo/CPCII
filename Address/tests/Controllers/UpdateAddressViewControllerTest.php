<?php

namespace Address\Controllers {

    use Address\Entities\Address;
    use Address\Forms\FormPopulate;
    use Address\Gateways\AddressTableDataGateway;
    use Address\Http\Request;
    use Address\Http\Response;
    use Address\Http\Session;

    /**
     * @covers Address\Controllers\UpdateAddressViewController
     * @uses Address\Entities\Address
     * @uses Address\Forms\FormPopulate
     * @uses Address\Gateways\AddressTableDataGateway
     * @uses Address\Http\Request
     * @uses Address\Http\Response
     * @uses Address\Http\Session
     */
    class UpdateAddressViewControllerTest extends \PHPUnit_Framework_TestCase
    {
        /** @var Request | \PHPUnit_Framework_MockObject_MockObject */
        private $request;

        /** @var Response | \PHPUnit_Framework_MockObject_MockObject */
        private $response;

        /** @var Session | \PHPUnit_Framework_MockObject_MockObject */
        private $session;

        /** @var AddressTableDataGateway | \PHPUnit_Framework_MockObject_MockObject */
        private $dataGateway;

        /** @var Address | \PHPUnit_Framework_MockObject_MockObject */
        private $address;

        /** @var FormPopulate | \PHPUnit_Framework_MockObject_MockObject */
        private $formPopulate;

        /** @var UpdateAddressViewController */
        private $updateAddressViewController;

        protected function setUp()
        {
            $this->request = $this->getMockBuilder(Request::class)->disableOriginalConstructor()->getMock();
            $this->response = $this->getMockBuilder(Response::class)->disableOriginalConstructor()->getMock();
            $this->address = $this->getMockBuilder(Address::class)->disableOriginalConstructor()->getMock();
            $this->dataGateway = $this->getMockBuilder(AddressTableDataGateway::class)->disableOriginalConstructor()->getMock();
            $this->session = $this->getMockBuilder(Session::class)->disableOriginalConstructor()->getMock();
            $this->formPopulate = $this->getMockBuilder(FormPopulate::class)->disableOriginalConstructor()->getMock();

            $this->updateAddressViewController = new UpdateAddressViewController($this->session, $this->dataGateway, $this->formPopulate);
        }

        public function testControllerCanBeExecutedAndReturnsRightTemplate()
        {
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

            $this->formPopulate
                ->expects($this->at(0))
                ->method('set')
                ->with('address1', 'Obi-Van Kenobi');

            $this->response
                ->expects($this->exactly(4))
                ->method('getAddress')
                ->willReturn($this->address);

            $this->address
                ->expects($this->once())
                ->method('getAddress1')
                ->willReturn('Obi-Van Kenobi');

            $this->formPopulate
                ->expects($this->at(1))
                ->method('set')
                ->with('address2', 'Milky Way');

            $this->address
                ->expects($this->once())
                ->method('getAddress2')
                ->willReturn('Milky Way');

            $this->formPopulate
                ->expects($this->at(2))
                ->method('set')
                ->with('city', 'Galaxy');

            $this->address
                ->expects($this->once())
                ->method('getCity')
                ->willReturn('Galaxy');

            $this->formPopulate
                ->expects($this->at(3))
                ->method('set')
                ->with('postalCode', 1234);

            $this->address
                ->expects($this->once())
                ->method('getPostalCode')
                ->willReturn(1234);

            $this->session
                ->expects($this->once())
                ->method('isset')
                ->with('error')
                ->willReturn(false);

            $this->assertEquals('addresses/updateaddress.twig', $this->updateAddressViewController->execute($this->request, $this->response));
        }

        public function testSessionErrorCanBeDeleted()
        {
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

            $this->formPopulate
                ->expects($this->at(0))
                ->method('set')
                ->with('address1', 'Obi-Van Kenobi');

            $this->response
                ->expects($this->exactly(4))
                ->method('getAddress')
                ->willReturn($this->address);

            $this->address
                ->expects($this->once())
                ->method('getAddress1')
                ->willReturn('Obi-Van Kenobi');

            $this->formPopulate
                ->expects($this->at(1))
                ->method('set')
                ->with('address2', 'Milky Way');

            $this->address
                ->expects($this->once())
                ->method('getAddress2')
                ->willReturn('Milky Way');

            $this->formPopulate
                ->expects($this->at(2))
                ->method('set')
                ->with('city', 'Galaxy');

            $this->address
                ->expects($this->once())
                ->method('getCity')
                ->willReturn('Galaxy');

            $this->formPopulate
                ->expects($this->at(3))
                ->method('set')
                ->with('postalCode', 1234);

            $this->address
                ->expects($this->once())
                ->method('getPostalCode')
                ->willReturn(1234);

            $this->session
                ->expects($this->once())
                ->method('isset')
                ->with('error')
                ->willReturn(true);

            $this->session
                ->expects($this->once())
                ->method('deleteValue')
                ->with('error');

            $this->assertEquals('addresses/updateaddress.twig', $this->updateAddressViewController->execute($this->request, $this->response));
        }


        public function testIfRequestHasValueIdButItsEmptyReturnsErrorTemplate ()
        {
            $this->request
                ->expects($this->once())
                ->method('hasValue')
                ->with('id')
                ->willReturn(true);

            $this->request
                ->expects($this->once())
                ->method('getValue')
                ->with('id')
                ->willReturn('');

            $this->assertEquals('templates/errors/404.twig', $this->updateAddressViewController->execute($this->request, $this->response));
        }
    }
}
