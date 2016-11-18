<?php

/**
 * @covers SuxxProductController
 * @uses SuxxRequest
 * @uses SuxxResponse
 * @uses SuxxProductTableDataGateway
 * @uses SuxxCommentTableDataGateway
 * @uses SuxxProduct
 * @uses SuxxComment
 */
class SuxxProductControllerTest extends PHPUnit_Framework_TestCase
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
     * @var PHPUnit_Framework_MockObject_MockObject | SuxxCommentTableDataGateway
     */
    private $commentDataGateway;

    /**
     * @var SuxxProductController
     */
    private $productController;

    /**
     * @var PHPUnit_Framework_MockObject_MockObject | SuxxProduct
     */
    private $product;

    /**
     * @var PHPUnit_Framework_MockObject_MockObject | SuxxComment
     */
    private $comment;

    protected function setUp()
    {
        $this->request = $this->getMockBuilder(SuxxRequest::class)->disableOriginalConstructor()->getMock();
        $this->response = $this->getMockBuilder(SuxxResponse::class)->disableOriginalConstructor()->getMock();
        $this->productDataGateway = $this->getMockBuilder(SuxxProductTableDataGateway::class)->disableOriginalConstructor()->getMock();
        $this->commentDataGateway = $this->getMockBuilder(SuxxCommentTableDataGateway::class)->disableOriginalConstructor()->getMock();
        $this->product = $this->getMockBuilder(SuxxProduct::class)->disableOriginalConstructor()->getMock();
        $this->comment = $this->getMockBuilder(SuxxComment::class)->disableOriginalConstructor()->getMock();

        $this->productController = new SuxxProductController($this->productDataGateway, $this->commentDataGateway);
    }

    public function testControllerCanBeExecutedAndReturnsRightTemplate()
    {
        $this->request
            ->expects($this->exactly(3))
            ->method('getValue')
            ->with('pid')
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

        $this->response
            ->expects($this->once())
            ->method('setComments')
            ->with(array($this->comment));

        $this->commentDataGateway
            ->expects($this->once())
            ->method('findCommentsByPid')
            ->with(1)
            ->willReturn(array($this->comment));

        $this->assertEquals('product.twig', $this->productController->execute($this->request, $this->response));
    }

    public function testControllerReturnsErrorViewWithoutGivenPid()
    {
        $this->request
            ->expects($this->once())
            ->method('getValue')
            ->with('pid')
            ->willReturn('');

        $this->assertEquals('404errorview.twig', $this->productController->execute($this->request, $this->response));
    }
}
