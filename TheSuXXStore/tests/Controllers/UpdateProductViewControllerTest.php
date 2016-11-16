<?php

class SuxxUpdateProductViewControllerTest extends PHPUnit_Framework_TestCase
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
     * @var PHPUnit_Framework_MockObject_MockObject | SuxxProductTableDataGateway
     */
    private $productDataGateway;

    /**
     * @var PHPUnit_Framework_MockObject_MockObject | SuxxSession
     */
    private $session;

    /**
     * @var PHPUnit_Framework_MockObject_MockObject | SuxxFormPopulate
     */
    private $formPopulate;

    /**
     * @var SuxxUpdateProductViewController
     */
    private $updateProductViewController;

    /**
     * @var PHPUnit_Framework_MockObject_MockObject | SuxxProduct
     */
    private $product;

    protected function setUp()
    {
        $this->request = $this->getMockBuilder(SuxxRequest::class)->disableOriginalConstructor()->getMock();
        $this->response = $this->getMockBuilder(SuxxResponse::class)->disableOriginalConstructor()->getMock();
        $this->productDataGateway = $this->getMockBuilder(SuxxProductTableDataGateway::class)->disableOriginalConstructor()->getMock();
        $this->session = $this->getMockBuilder(SuxxSession::class)->disableOriginalConstructor()->getMock();
        $this->formPopulate = $this->getMockBuilder(SuxxFormPopulate::class)->disableOriginalConstructor()->getMock();
        $this->product = $this->getMockBuilder(SuxxProduct::class)->disableOriginalConstructor()->getMock();

        $this->updateProductViewController = new SuxxUpdateProductViewController($this->session, $this->productDataGateway, $this->formPopulate);
    }

    public function testControllerCanBeExecutedAndReturnsRightTemplate()
    {
        $this->request
            ->expects($this->at(0))
            ->method('getValue')
            ->with('product')
            ->willReturn(1);

        $this->response
            ->expects($this->once())
            ->method('setProduct')
            ->with($this->product);

        $this->productDataGateway
            ->expects($this->once())
            ->method('findProductById')
            ->with(1)
            ->willReturn($this->product);

        $this->request
            ->expects($this->at(1))
            ->method('getValue')
            ->with('pid')
            ->willReturn(1);

        $this->formPopulate
            ->expects($this->at(0))
            ->method('set')
            ->with('label', 'Test Produkt');

        $this->response
            ->expects($this->exactly(2))
            ->method('getProduct')
            ->willReturn($this->product);

        $this->product
            ->expects($this->once())
            ->method('getLabel')
            ->willReturn('Test Produkt');

        $this->formPopulate
            ->expects($this->at(1))
            ->method('set')
            ->with('price', 123);

        $this->product
            ->expects($this->once())
            ->method('getPrice')
            ->willReturn(123);

        $this->session
            ->expects($this->once())
            ->method('isset')
            ->with('error')
            ->willReturn(false);

        $this->assertEquals('updateproduct.twig', $this->updateProductViewController->execute($this->request, $this->response));
    }

    public function testExecutionWithoutProductIdReturnsErrorView()
    {

        $this->request
            ->expects($this->at(0))
            ->method('getValue')
            ->with('product')
            ->willReturn('');

        $this->assertEquals('404errorview.twig', $this->updateProductViewController->execute($this->request, $this->response));
    }

    public function testSessionErrorCanBeDeleted()
    {
        $this->request
            ->expects($this->at(0))
            ->method('getValue')
            ->with('product')
            ->willReturn(1);

        $this->response
            ->expects($this->once())
            ->method('setProduct')
            ->with($this->product);

        $this->productDataGateway
            ->expects($this->once())
            ->method('findProductById')
            ->with(1)
            ->willReturn($this->product);

        $this->request
            ->expects($this->at(1))
            ->method('getValue')
            ->with('pid')
            ->willReturn(1);

        $this->formPopulate
            ->expects($this->at(0))
            ->method('set')
            ->with('label', 'Test Produkt');

        $this->response
            ->expects($this->exactly(2))
            ->method('getProduct')
            ->willReturn($this->product);

        $this->product
            ->expects($this->once())
            ->method('getLabel')
            ->willReturn('Test Produkt');

        $this->formPopulate
            ->expects($this->at(1))
            ->method('set')
            ->with('price', 123);

        $this->product
            ->expects($this->once())
            ->method('getPrice')
            ->willReturn(123);

        $this->session
            ->expects($this->once())
            ->method('isset')
            ->with('error')
            ->willReturn(true);

        $this->session
            ->expects($this->once())
            ->method('deleteValue')
            ->with('error');

        $this->assertEquals('updateproduct.twig', $this->updateProductViewController->execute($this->request, $this->response));
    }
}
