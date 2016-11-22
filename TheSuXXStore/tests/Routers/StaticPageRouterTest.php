<?php

namespace Suxx\Routers {

    use Suxx\Factories\Factory;
    use Suxx\Http\Request;
    use Suxx\FileHandlers\UploadedFile;

    /**
     * @covers  Suxx\Routers\StaticPageRouter
     * @uses    Suxx\Factories\Factory
     * @uses    Suxx\FileHandlers\UploadedFile
     * @uses    Suxx\Http\Request
     */
    class StaticPageRouterTest extends \PHPUnit_Framework_TestCase
    {
        /**
         * @var \PHPUnit_Framework_MockObject_MockObject | Factory
         */
        private $factory;

        /**
         * @var StaticPageRouter
         */
        private $staticPageRouter;

        /**
         * @var \PHPUnit_Framework_MockObject_MockObject | UploadedFile
         */
        private $file;

        protected function setUp()
        {
            $this->factory = $this->getMockBuilder(Factory::class)->disableOriginalConstructor()->getMock();
            $this->file = $this->getMockBuilder(UploadedFile::class)->disableOriginalConstructor()->getMock();
            $this->staticPageRouter = new StaticPageRouter($this->factory);
        }

        /**
         * @dataProvider provideData
         * @param $path
         * @param $instance
         */
        public function testRouterWorksFine($path, $instance)
        {
            $request = new Request(
                [],
                ['REQUEST_URI' => $path, 'REQUEST_METHOD' => 'GET'],
                $this->file
            );

            $this->assertInstanceOf($instance, $this->staticPageRouter->route($request));
        }

        public function testRouterReturnsNullIfNotGetRequest()
        {
            $request = new Request(
                ['csrf' => '1234567890'],
                ['REQUEST_URI' => '/suxx', 'REQUEST_METHOD' => 'POST'],
                $this->file
            );

            $this->assertEquals(null, $this->staticPageRouter->route($request));
        }

        public function testRouterReturnsNullIfInvalidRequestUri()
        {
            $request = new Request(
                ['csrf' => '1234567890'],
                ['REQUEST_URI' => '/invalid', 'REQUEST_METHOD' => 'GET'],
                $this->file
            );

            $this->assertEquals(null, $this->staticPageRouter->route($request));
        }

        public function provideData()
        {
            return [
                ['/', \Suxx\Controllers\HomeController::class],
                ['/loginview', \Suxx\Controllers\LoginViewController::class],
                ['/registerview', \Suxx\Controllers\RegisterViewController::class],
                ['/suxx/product', \Suxx\Controllers\ProductController::class],
                ['/suxx/updateproductview', \Suxx\Controllers\UpdateProductViewController::class],
                ['/suxx/logout', \Suxx\Controllers\LogoutController::class],
            ];
        }
    }
}
