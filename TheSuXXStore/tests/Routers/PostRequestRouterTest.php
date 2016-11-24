<?php

namespace Suxx\Routers {

    use Suxx\Controllers\Error500Controller;
    use Suxx\Controllers\HomeController;
    use Suxx\Factories\Factory;
    use Suxx\Http\Request;
    use Suxx\Http\Session;
    use Suxx\FileHandlers\UploadedFile;
    use Suxx\Loggers\ErrorLogger;

    /**
     * @covers  Suxx\Routers\PostRequestRouter
     * @uses    Suxx\Factories\Factory
     * @uses    Suxx\Http\Session
     * @uses    Suxx\FileHandlers\UploadedFile
     * @uses    Suxx\Http\Request
     * @uses    Suxx\Loggers\ErrorLogger
     */
    class PostRequestRouterTest extends \PHPUnit_Framework_TestCase
    {
        /**
         * @var \PHPUnit_Framework_MockObject_MockObject | Factory
         */
        private $factory;

        /**
         * @var \PHPUnit_Framework_MockObject_MockObject | Session
         */
        private $session;

        /**
         * @var \PHPUnit_Framework_MockObject_MockObject | UploadedFile
         */
        private $file;

        /**
         * @var PostRequestRouter
         */
        private $postRequestRouter;

        /**
         * @var \PHPUnit_Framework_MockObject_MockObject | ErrorLogger
         */
        private $errorLogger;

        protected function setUp()
        {
            $this->factory = $this->getMockBuilder(Factory::class)->disableOriginalConstructor()->getMock();
            $this->session = $this->getMockBuilder(Session::class)->disableOriginalConstructor()->getMock();
            $this->file = $this->getMockBuilder(UploadedFile::class)->disableOriginalConstructor()->getMock();
            $this->errorLogger = $this->getMockBuilder(ErrorLogger::class)->disableOriginalConstructor()->getMock();
            $this->postRequestRouter = new PostRequestRouter($this->factory, $this->session, $this->errorLogger);
        }

        /**
         * @dataProvider provideData
         * @param $path
         * @param $instance
         */
        public function testRouterWorksFine($path, $instance)
        {
            $request = new Request(
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
            $request = new Request(
                ['csrf' => '1234567890'],
                ['REQUEST_URI' => '/suxx', 'REQUEST_METHOD' => 'GET'],
                $this->file
            );

            $this->assertEquals(null, $this->postRequestRouter->route($request));
        }

        public function testInvalidCsrfTokenReturnsError500Controller()
        {
            $request = new Request(
                ['csrf' => 'session hi-jackers token'],
                ['REQUEST_URI' => '/suxx', 'REQUEST_METHOD' => 'POST'],
                $this->file
            );

            $this->assertInstanceOf(Error500Controller::class, $this->postRequestRouter->route($request));
        }

        public function testRouterReturnsNullIfInvalidRequestUri()
        {
            $request = new Request(
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
                ['/suxx/comment', \Suxx\Controllers\CommentController::class],
                ['/suxx/updateproduct', \Suxx\Controllers\UpdateProductController::class],
            ];
        }
    }
}
