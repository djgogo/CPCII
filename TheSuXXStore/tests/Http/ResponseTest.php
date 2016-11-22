<?php
namespace Suxx\Http {

    use Suxx\Entities\Product;
    use Suxx\Entities\Comment;
    use Suxx\Exceptions\ResponseException;

    /**
     * @covers Suxx\Http\Response
     * @uses   Suxx\Entities\Product
     * @uses   Suxx\Entities\Comment
     */
    class ResponseTest extends \PHPUnit_Framework_TestCase
    {
        /**
         * @var array
         */
        private $products;

        /**
         * @var Product
         */
        private $product;

        /**
         * @var string
         */
        private $redirect;

        /**
         * @var Response
         */
        private $response;

        /**
         * @var array
         */
        private $comments;

        protected function setUp()
        {
            $this->products = [
                new Product(
                    [
                    'pid' => 1,
                    'label' => 'Test Produkt',
                    'price' => '99'
                    ]
                ),
                new Product(
                    [
                    'pid' => 2,
                    'label' => 'Test Produkt2',
                    'price' => '100'
                    ]
                )];

            $this->product = new Product(
                [
                'pid' => 1,
                'label' => 'Test Produkt',
                'price' => '99'
                ]
            );

            $this->comments = [
                new Comment(),
                new Comment(),
                new Comment()
            ];

            $this->redirect = '/goSomeWhere';

            $this->response = new Response();
        }

        public function testValueCanBeSetAndRetrieved()
        {
            $this->response->setValue('testData', 'test');
            $this->assertEquals('test', $this->response->getValue('testData'));
        }

        public function testGetValueThrowsExceptionIfNotFound()
        {
            $this->expectException(ResponseException::class);
            $this->response->getValue('wrongKey');
        }

        public function testIssetReturnsRightBoolean()
        {
            $this->response->setValue('testData', 'test');
            $this->assertTrue($this->response->isset('testData'));
        }

        public function testProductCanBeSetAndRetrieved()
        {
            $this->response->setProduct($this->product);
            $this->assertEquals($this->product, $this->response->getProduct());
        }

        public function testProductsCanBeSetAndRetrieved()
        {
            $this->response->setProducts($this->products);
            $this->assertEquals($this->products, $this->response->getProducts());
        }

        public function testCommentsCanBeSetAndRetrieved()
        {
            $this->response->setComments($this->comments);
            $this->assertEquals($this->comments, $this->response->getComments());
        }

        public function testRedirectCanBeSetAndRetrieved()
        {
            $this->response->setRedirect($this->redirect);
            $this->assertEquals($this->redirect, $this->response->getRedirect());
        }

        public function testHasRedirectReturnsRightBoolean()
        {
            $this->response->setRedirect($this->redirect);
            $this->assertTrue($this->response->hasRedirect());
        }
    }
}
