<?php

/**
 * @covers SuxxUpdateProductController
 * @uses SuxxRequest
 * @uses SuxxResponse
 * @uses SuxxUpdateProductFormCommand
 * @uses SuxxProductTableDataGateway
 */
class SuxxUpdateProductControllerTest extends PHPUnit_Framework_TestCase
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
     * @var PHPUnit_Framework_MockObject_MockObject | SuxxUpdateProductFormCommand
     */
    private $updateProductFormCommand;

    /**
     * @var SuxxUpdateProductController
     */
    private $updateProductController;

    /**
     * @var PHPUnit_Framework_MockObject_MockObject | SuxxProductTableDataGateway
     */
    private $productDataGateway;

    /**
     * @var PHPUnit_Framework_MockObject_MockObject | SuxxProduct
     */
    private $product;


    protected function setUp()
    {
        $this->request = $this->getMockBuilder(SuxxRequest::class)->disableOriginalConstructor()->getMock();
        $this->response = $this->getMockBuilder(SuxxResponse::class)->disableOriginalConstructor()->getMock();
        $this->product = $this->getMockBuilder(SuxxProduct::class)->disableOriginalConstructor()->getMock();
        $this->productDataGateway = $this->getMockBuilder(SuxxProductTableDataGateway::class)->disableOriginalConstructor()->getMock();
        $this->updateProductFormCommand = $this->getMockBuilder(SuxxUpdateProductFormCommand::class)->disableOriginalConstructor()->getMock();

        $this->updateProductController = new SuxxUpdateProductController($this->updateProductFormCommand, $this->productDataGateway);
    }

    public function testControllerCanBeExecutedAndSetsRightRedirect()
    {
        $this->updateProductFormCommand
            ->expects($this->once())
            ->method('execute')
            ->with($this->request)
            ->willReturn(true);

        $this->response
            ->expects($this->once())
            ->method('setProducts')
            ->with(array($this->product));

        $this->productDataGateway
            ->expects($this->once())
            ->method('getAllProducts')
            ->willReturn(array($this->product));

        $this->response
            ->expects($this->once())
            ->method('setRedirect')
            ->with('/');

        $this->updateProductController->execute($this->request, $this->response);
    }

    public function testControllerRepopulateFormFieldsAndReturnsRightTemplateOnError()
    {
        $this->updateProductFormCommand
            ->expects($this->once())
            ->method('execute')
            ->with($this->request)
            ->willReturn(false);

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
            ->expects($this->once())
            ->method('getValue')
            ->with('product-id')
            ->willReturn(1);

        $this->updateProductFormCommand
            ->expects($this->once())
            ->method('repopulateForm');

        $this->assertEquals('updateproduct.twig', $this->updateProductController->execute($this->request, $this->response));
    }
}
