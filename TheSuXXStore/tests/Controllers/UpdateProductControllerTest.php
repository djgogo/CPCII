<?php

namespace Suxx\Controllers {

    use Suxx\Http\Request;
    use Suxx\Http\Response;
    use Suxx\Commands\UpdateProductFormCommand;
    use Suxx\Gateways\ProductTableDataGateway;
    use Suxx\Entities\Product;

    /**
     * @covers Suxx\Controllers\UpdateProductController
     * @uses   Suxx\Http\Request
     * @uses   Suxx\Http\Response
     * @uses   Suxx\Commands\UpdateProductFormCommand
     * @uses   Suxx\Gateways\ProductTableDataGateway
     * @uses   Suxx\Entities\Product
     */
    class UpdateProductControllerTest extends \PHPUnit_Framework_TestCase
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
         * @var \PHPUnit_Framework_MockObject_MockObject | UpdateProductFormCommand
         */
        private $updateProductFormCommand;

        /**
         * @var UpdateProductController
         */
        private $updateProductController;

        /**
         * @var \PHPUnit_Framework_MockObject_MockObject | ProductTableDataGateway
         */
        private $productDataGateway;

        /**
         * @var \PHPUnit_Framework_MockObject_MockObject | Product
         */
        private $product;


        protected function setUp()
        {
            $this->request = $this->getMockBuilder(Request::class)->disableOriginalConstructor()->getMock();
            $this->response = $this->getMockBuilder(Response::class)->disableOriginalConstructor()->getMock();
            $this->product = $this->getMockBuilder(Product::class)->disableOriginalConstructor()->getMock();
            $this->productDataGateway = $this->getMockBuilder(ProductTableDataGateway::class)->disableOriginalConstructor()->getMock();
            $this->updateProductFormCommand = $this->getMockBuilder(UpdateProductFormCommand::class)->disableOriginalConstructor()->getMock();

            $this->updateProductController = new UpdateProductController($this->updateProductFormCommand, $this->productDataGateway);
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
}
