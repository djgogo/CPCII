<?php

namespace Address\Controllers {

    use Address\Gateways\AddressTableDataGateway;
    use Address\Http\Request;
    use Address\Http\Response;
    use Address\Http\Session;

    /**
     * @covers Address\Controllers\HomeController
     * @uses Address\Gateways\AddressTableDataGateway
     * @uses Address\Http\Request
     * @uses Address\Http\Response
     * @uses Address\Http\Session
     */
    class HomeControllerTest extends \PHPUnit_Framework_TestCase
    {
        /** @var Request | \PHPUnit_Framework_MockObject_MockObject */
        private $request;

        /** @var Response | \PHPUnit_Framework_MockObject_MockObject */
        private $response;

        /** @var Session | \PHPUnit_Framework_MockObject_MockObject */
        private $session;

        /** @var AddressTableDataGateway | \PHPUnit_Framework_MockObject_MockObject */
        private $dataGateway;

        /** @var HomeController */
        private $homeController;

        protected function setUp()
        {
            $this->request = $this->getMockBuilder(Request::class)->disableOriginalConstructor()->getMock();
            $this->response = $this->getMockBuilder(Response::class)->disableOriginalConstructor()->getMock();
            $this->session = $this->getMockBuilder(Session::class)->disableOriginalConstructor()->getMock();
            $this->dataGateway = $this->getMockBuilder(AddressTableDataGateway::class)->disableOriginalConstructor()->getMock();

            $this->homeController = new HomeController($this->session, $this->dataGateway);
        }

        public function testDefaultCaseCanBeExecutedAndReturnsHomeTemplate()
        {
            $this->request
                ->expects($this->at(0))
                ->method('hasValue')
                ->with('sort')
                ->willReturn(false);

            $this->request
                ->expects($this->at(1))
                ->method('hasValue')
                ->with('search')
                ->willReturn(false);

            $this->response
                ->expects($this->once())
                ->method('setAddresses');

            $this->dataGateway
                ->expects($this->once())
                ->method('getAllAddresses')
                ->willReturn(array());

            $this->session
                ->expects($this->once())
                ->method('setValue')
                ->with('sort', '');

            $this->assertEquals('home.twig', $this->homeController->execute($this->request, $this->response));
        }

        public function testSortAscendingCanBeExecuted()
        {
            $this->request
                ->expects($this->at(0))
                ->method('hasValue')
                ->with('sort')
                ->willReturn(true);

            $this->request
                ->expects($this->once())
                ->method('getValue')
                ->with('sort')
                ->willReturn('ASC');

            $this->response
                ->expects($this->once())
                ->method('setAddresses');

            $this->dataGateway
                ->expects($this->once())
                ->method('getAllAddressesOrderedByUpdatedAscending')
                ->willReturn(array());

            $this->session
                ->expects($this->once())
                ->method('setValue')
                ->with('sort', 'ASC');

            $this->assertEquals('home.twig', $this->homeController->execute($this->request, $this->response));
        }

        public function testSortDescendingCanBeExecuted()
        {
            $this->request
                ->expects($this->at(0))
                ->method('hasValue')
                ->with('sort')
                ->willReturn(true);

            $this->request
                ->expects($this->exactly(2))
                ->method('getValue')
                ->with('sort')
                ->willReturn('DESC');

            $this->response
                ->expects($this->once())
                ->method('setAddresses');

            $this->dataGateway
                ->expects($this->once())
                ->method('getAllAddressesOrderedByUpdatedDescending')
                ->willReturn(array());

            $this->session
                ->expects($this->once())
                ->method('setValue')
                ->with('sort', 'DESC');

            $this->assertEquals('home.twig', $this->homeController->execute($this->request, $this->response));
        }

        public function testExecutionWithSearchValueWorks()
        {
            $this->request
                ->expects($this->at(0))
                ->method('hasValue')
                ->with('sort')
                ->willReturn(false);

            $this->response
                ->expects($this->at(0))
                ->method('setAddresses');

            $this->dataGateway
                ->expects($this->once())
                ->method('getAllAddresses')
                ->willReturn(array());

            $this->session
                ->expects($this->once())
                ->method('setValue')
                ->with('sort', '');

            $this->request
                ->expects($this->at(1))
                ->method('hasValue')
                ->with('search')
                ->willReturn(true);

            $this->response
                ->expects($this->at(1))
                ->method('setAddresses');

            $this->dataGateway
                ->expects($this->once())
                ->method('getSearchedAddress')
                ->willReturn(array());

            $this->request
                ->expects($this->at(2))
                ->method('getValue')
                ->with('search')
                ->willReturn('search String');

            $this->assertEquals('home.twig', $this->homeController->execute($this->request, $this->response));
        }
    }
}
