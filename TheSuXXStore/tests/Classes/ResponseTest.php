<?php

/**
 * @covers SuxxResponse
 * @uses SuxxProduct
 * @uses SuxxComment
 */
class SuxxResponseTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var array
     */
    private $products;

    /**
     * @var SuxxProduct
     */
    private $product;

    /**
     * @var string
     */
    private $redirect;

    /**
     * @var SuxxResponse
     */
    private $response;

    /**
     * @var array
     */
    private $comments;

    protected function setUp()
    {
        $this->products = [
            new SuxxProduct(
                [
                'pid' => 1,
                'label' => 'Test Produkt',
                'price' => '99'
                ]
            ),
            new SuxxProduct(
                [
                'pid' => 2,
                'label' => 'Test Produkt2',
                'price' => '100'
                ]
            )];

        $this->product = new SuxxProduct(
            [
            'pid' => 1,
            'label' => 'Test Produkt',
            'price' => '99'
            ]
        );

        $this->comments = [
            new SuxxComment(),
            new SuxxComment(),
            new SuxxComment()
        ];

        $this->redirect = '/goSomeWhere';

        $this->response = new SuxxResponse();
    }

    public function testValueCanBeSetAndRetrieved()
    {
        $this->response->setValue('testData', 'test');
        $this->assertEquals('test', $this->response->getValue('testData'));
    }

    public function testGetValueThrowsExceptionIfNotFound()
    {
        $this->expectException(SuxxResponseException::class);
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
