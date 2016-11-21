<?php

/**
 * @covers SuxxHomeController
 * @uses SuxxRequest
 * @uses SuxxResponse
 */
class SuxxHomeControllerTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var PHPUnit_Framework_MockObject_MockObject | SuxxRequest
     */
    private $request;

    /**
     * @var PHPUnit_Framework_MockObject_MockObject | SuxxResponse
     */
    private $response;

    /**
     * @var PHPUnit_Framework_MockObject_MockObject | SuxxSession
     */
    private $session;

    /**
     * @var PHPUnit_Framework_MockObject_MockObject | SuxxProductTableDataGateway
     */
    private $dataGateway;

    /**
     * @var SuxxHomeController
     */
    private $homeController;

    public function setUp()
    {
        $this->request = $this->getMockBuilder(SuxxRequest::class)->disableOriginalConstructor()->getMock();
        $this->response = $this->getMockBuilder(SuxxResponse::class)->disableOriginalConstructor()->getMock();
        $this->session = $this->getMockBuilder(SuxxSession::class)->disableOriginalConstructor()->getMock();
        $this->dataGateway = $this->getMockBuilder(SuxxProductTableDataGateway::class)->disableOriginalConstructor()->getMock();

        $this->homeController = new SuxxHomeController($this->session, $this->dataGateway);
    }

    public function testHomeControllerCanBeExecutedWithDefaultCaseAndReturnsBaseTemplate()
    {
        $this->request
            ->expects($this->at(0))
            ->method('getValue')
            ->with('sort')
            ->willReturn('');

        $this->request
            ->expects($this->at(1))
            ->method('getValue')
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
            ->method('getValue')
            ->with('sort')
            ->willReturn('ASC');

        $this->request
            ->expects($this->at(1))
            ->method('getValue')
            ->with('search')
            ->willReturn(false);

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
            ->method('getValue')
            ->with('sort')
            ->willReturn('DESC');

        $this->request
            ->expects($this->at(1))
            ->method('getValue')
            ->with('search')
            ->willReturn(false);

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
            ->method('getValue')
            ->with('sort')
            ->willReturn('');

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
            ->method('getValue')
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
