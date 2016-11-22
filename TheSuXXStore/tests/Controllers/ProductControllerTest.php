<?php

namespace Suxx\Controllers {

    use Suxx\Http\Request;
    use Suxx\Http\Response;
    use Suxx\Gateways\ProductTableDataGateway;
    use Suxx\Gateways\CommentTableDataGateway;
    use Suxx\Entities\Product;
    use Suxx\Entities\Comment;

    /**
     * @covers Suxx\Controllers\ProductController
     * @uses   Suxx\Http\Request
     * @uses   Suxx\Http\Response
     * @uses   Suxx\Gateways\ProductTableDataGateway
     * @uses   Suxx\Gateways\CommentTableDataGateway
     * @uses   Suxx\Entities\Product
     * @uses   Suxx\Entities\Comment
     */
    class ProductControllerTest extends \PHPUnit_Framework_TestCase
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
         * @var \PHPUnit_Framework_MockObject_MockObject | CommentTableDataGateway
         */
        private $commentDataGateway;

        /**
         * @var ProductController
         */
        private $productController;

        /**
         * @var \PHPUnit_Framework_MockObject_MockObject | Product
         */
        private $product;

        /**
         * @var \PHPUnit_Framework_MockObject_MockObject | Comment
         */
        private $comment;

        protected function setUp()
        {
            $this->request = $this->getMockBuilder(Request::class)->disableOriginalConstructor()->getMock();
            $this->response = $this->getMockBuilder(Response::class)->disableOriginalConstructor()->getMock();
            $this->productDataGateway = $this->getMockBuilder(ProductTableDataGateway::class)->disableOriginalConstructor()->getMock();
            $this->commentDataGateway = $this->getMockBuilder(CommentTableDataGateway::class)->disableOriginalConstructor()->getMock();
            $this->product = $this->getMockBuilder(Product::class)->disableOriginalConstructor()->getMock();
            $this->comment = $this->getMockBuilder(Comment::class)->disableOriginalConstructor()->getMock();

            $this->productController = new ProductController($this->productDataGateway, $this->commentDataGateway);
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
}
