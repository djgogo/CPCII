<?php

class SuxxPostRequestRouterTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var PHPUnit_Framework_MockObject_MockObject | SuxxFactory
     */
    private $factory;

    /**
     * @var PHPUnit_Framework_MockObject_MockObject | SuxxSession
     */
    private $session;

    /**
     * @var PHPUnit_Framework_MockObject_MockObject | SuxxUploadedFile
     */
    private $file;

    /**
     * @var SuxxPostRequestRouter
     */
    private $postRequestRouter;

    protected function setUp()
    {
        $this->factory = $this->getMockBuilder(SuxxFactory::class)->disableOriginalConstructor()->getMock();
        $this->session = $this->getMockBuilder(SuxxSession::class)->disableOriginalConstructor()->getMock();
        $this->file = $this->getMockBuilder(SuxxUploadedFile::class)->disableOriginalConstructor()->getMock();
        $this->postRequestRouter = new SuxxPostRequestRouter($this->factory, $this->session);
    }

    /**
     * @dataProvider provideData
     * @param $path
     * @param $instance
     */
    public function testRouterWorksFine($path, $instance)
    {
        $request = new SuxxRequest(
            ['csrf' => '1234567890'],
            ['REQUEST_URI' => $path, 'REQUEST_METHOD' => 'POST'],
            $this->file
        );

        $this->session
            ->expects($this->once())
            ->method('getValue')
            ->with('token')
            ->willReturn('1234567890');

        $this->assertInstanceOf($instance, $this->postRequestRouter->route($request));
    }

    public function testRouterReturnsNullIfRequestIsNotAPostRequest()
    {
        $request = new SuxxRequest(
            ['csrf' => '1234567890'],
            ['REQUEST_URI' => '/suxx', 'REQUEST_METHOD' => 'GET'],
            $this->file
        );

        $this->assertEquals(null, $this->postRequestRouter->route($request));
    }

    public function testInvalidCsrfTokenReturnsHomeController()
    {
        $request = new SuxxRequest(
            ['csrf' => 'session hi-jackers token'],
            ['REQUEST_URI' => '/suxx', 'REQUEST_METHOD' => 'POST'],
            $this->file
        );

        $this->assertInstanceOf(SuxxHomeController::class, $this->postRequestRouter->route($request));
    }

    public function testRouterReturnsNullIfInvalidRequestUri()
    {
        $request = new SuxxRequest(
            ['csrf' => '1234567890'],
            ['REQUEST_URI' => '/invalid', 'REQUEST_METHOD' => 'POST'],
            $this->file
        );

        $this->session
            ->expects($this->once())
            ->method('getValue')
            ->with('token')
            ->willReturn('1234567890');

        $this->assertEquals(null, $this->postRequestRouter->route($request));
    }

    public function provideData()
    {
        return [
            ['/suxx/comment', SuxxCommentController::class],
            ['/suxx/updateproduct', SuxxUpdateProductController::class],
        ];
    }
}
