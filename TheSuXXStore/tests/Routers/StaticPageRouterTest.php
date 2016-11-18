<?php

class SuxxStaticPageRouterTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var PHPUnit_Framework_MockObject_MockObject | SuxxFactory
     */
    private $factory;

    /**
     * @var SuxxStaticPageRouter
     */
    private $staticPageRouter;

    /**
     * @var PHPUnit_Framework_MockObject_MockObject | SuxxUploadedFile
     */
    private $file;

    protected function setUp()
    {
        $this->factory = $this->getMockBuilder(SuxxFactory::class)->disableOriginalConstructor()->getMock();
        $this->file = $this->getMockBuilder(SuxxUploadedFile::class)->disableOriginalConstructor()->getMock();
        $this->staticPageRouter = new SuxxStaticPageRouter($this->factory);
    }

    /**
     * @dataProvider provideData
     * @param $path
     * @param $instance
     */
    public function testRouterWorksFine($path, $instance)
    {
        $request = new SuxxRequest(
            [],
            ['REQUEST_URI' => $path, 'REQUEST_METHOD' => 'GET'],
            $this->file
        );

        $this->assertInstanceOf($instance, $this->staticPageRouter->route($request));
    }

    public function testRouterReturnsNullIfNotGetRequest()
    {
        $request = new SuxxRequest(
            ['csrf' => '1234567890'],
            ['REQUEST_URI' => '/suxx', 'REQUEST_METHOD' => 'POST'],
            $this->file
        );

        $this->assertEquals(null, $this->staticPageRouter->route($request));
    }

    public function testRouterReturnsNullIfInvalidRequestUri()
    {
        $request = new SuxxRequest(
            ['csrf' => '1234567890'],
            ['REQUEST_URI' => '/invalid', 'REQUEST_METHOD' => 'GET'],
            $this->file
        );

        $this->assertEquals(null, $this->staticPageRouter->route($request));
    }

    public function provideData()
    {
        return [
            ['/', SuxxHomeController::class],
            ['/loginview', SuxxLoginViewController::class],
            ['/registerview', SuxxRegisterViewController::class],
            ['/suxx/product', SuxxProductController::class],
            ['/suxx/updateproductview', SuxxUpdateProductViewController::class],
            ['/suxx/logout', SuxxLogoutController::class],
        ];
    }
}
