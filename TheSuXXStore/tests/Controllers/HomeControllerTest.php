<?php

namespace Suxx\Controllers {

    use Suxx\Http\Request;
    use Suxx\Http\Response;
    use Suxx\Http\Session;
    use Suxx\Gateways\ProductTableDataGateway;

    /**
     * @covers  Suxx\Controllers\HomeController
     * @uses    Suxx\Http\Request
     * @uses    Suxx\Http\Response
     * @uses    Suxx\Http\Session
     * @uses    Suxx\Gateways\ProductTableDataGateway
     */
    class HomeControllerTest extends \PHPUnit_Framework_TestCase
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
         * @var \PHPUnit_Framework_MockObject_MockObject | Session
         */
        private $session;

        /**
         * @var \PHPUnit_Framework_MockObject_MockObject | ProductTableDataGateway
         */
        private $dataGateway;

        /**
         * @var HomeController
         */
        private $homeController;

        public function setUp()
        {
            $this->request = $this->getMockBuilder(Request::class)->disableOriginalConstructor()->getMock();
            $this->response = $this->getMockBuilder(Response::class)->disableOriginalConstructor()->getMock();
            $this->session = $this->getMockBuilder(Session::class)->disableOriginalConstructor()->getMock();
            $this->dataGateway = $this->getMockBuilder(ProductTableDataGateway::class)->disableOriginalConstructor()->getMock();

            $this->homeController = new HomeController($this->session, $this->dataGateway);
        }

        public function testHomeControllerCanBeExecutedWithDefaultCaseAndReturnsBaseTemplate()
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
                ->method('setProducts');

            $this->dataGateway
                ->expects($this->once())
                ->method('getAllProducts')
                ->willReturn(array());

            $this->session
                ->expects($this->once())
                ->method('setValue')
                ->with('sort', '');

            $this->assertEquals('base.twig', $this->homeController->execute($this->request, $this->response));
        }

        public function testHomeControllerWithSortAscendingCanBeExecuted()
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
                ->method('setProducts');

            $this->dataGateway
                ->expects($this->once())
                ->method('getAllProductsOrderedByUpdatedAscending')
                ->willReturn(array());

            $this->session
                ->expects($this->once())
                ->method('setValue')
                ->with('sort', 'ASC');

            $this->assertEquals('base.twig', $this->homeController->execute($this->request, $this->response));
        }

        public function testHomeControllerWithSortDescendingCanBeExecuted()
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
                ->method('setProducts');

            $this->dataGateway
                ->expects($this->once())
                ->method('getAllProductsOrderedByUpdatedDescending')
                ->willReturn(array());

            $this->session
                ->expects($this->once())
                ->method('setValue')
                ->with('sort', 'DESC');

            $this->assertEquals('base.twig', $this->homeController->execute($this->request, $this->response));
        }

        public function testHomeControllerCanBeExecutedWithSearchProduct()
        {
            $this->request
                ->expects($this->at(0))
                ->method('hasValue')
                ->with('sort')
                ->willReturn(false);

            $this->response
                ->expects($this->at(0))
                ->method('setProducts');

            $this->dataGateway
                ->expects($this->once())
                ->method('getAllProducts')
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
                ->method('setProducts');

            $this->dataGateway
                ->expects($this->once())
                ->method('getSearchedProduct')
                ->willReturn(array());

            $this->request
                ->expects($this->at(2))
                ->method('getValue')
                ->with('search')
                ->willReturn('search String');

            $this->assertEquals('base.twig', $this->homeController->execute($this->request, $this->response));
        }
    }
}
