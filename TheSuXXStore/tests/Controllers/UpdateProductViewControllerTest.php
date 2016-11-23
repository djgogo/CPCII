<?php

namespace Suxx\Controllers {

    use Suxx\Http\Request;
    use Suxx\Http\Response;
    use Suxx\Gateways\ProductTableDataGateway;
    use Suxx\Http\Session;
    use Suxx\Forms\FormPopulate;
    use Suxx\Entities\Product;

    /**
     * @covers  Suxx\Controllers\UpdateProductViewController
     * @uses    Suxx\Http\Request
     * @uses    Suxx\Http\Response
     * @uses    Suxx\Gateways\ProductTableDataGateway
     * @uses    Suxx\Http\Session
     * @uses    Suxx\Forms\FormPopulate
     * @uses    Suxx\Entities\Product
     */
    class UpdateProductViewControllerTest extends \PHPUnit_Framework_TestCase
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
         * @var \PHPUnit_Framework_MockObject_MockObject | ProductTableDataGateway
         */
        private $productDataGateway;

        /**
         * @var \PHPUnit_Framework_MockObject_MockObject | Session
         */
        private $session;

        /**
         * @var \PHPUnit_Framework_MockObject_MockObject | FormPopulate
         */
        private $formPopulate;

        /**
         * @var UpdateProductViewController
         */
        private $updateProductViewController;

        /**
         * @var \PHPUnit_Framework_MockObject_MockObject | Product
         */
        private $product;

        protected function setUp()
        {
            $this->request = $this->getMockBuilder(Request::class)->disableOriginalConstructor()->getMock();
            $this->response = $this->getMockBuilder(Response::class)->disableOriginalConstructor()->getMock();
            $this->productDataGateway = $this->getMockBuilder(ProductTableDataGateway::class)->disableOriginalConstructor()->getMock();
            $this->session = $this->getMockBuilder(Session::class)->disableOriginalConstructor()->getMock();
            $this->formPopulate = $this->getMockBuilder(FormPopulate::class)->disableOriginalConstructor()->getMock();
            $this->product = $this->getMockBuilder(Product::class)->disableOriginalConstructor()->getMock();

            $this->updateProductViewController = new UpdateProductViewController($this->session, $this->productDataGateway, $this->formPopulate);
        }

        public function testControllerCanBeExecutedAndReturnsRightTemplate()
        {
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

        public function testSessionErrorCanBeDeleted()
        {
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
}
