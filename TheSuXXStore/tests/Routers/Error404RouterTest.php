<?php

namespace Suxx\Routers {

    use Suxx\Controllers\Error404Controller;
    use Suxx\Factories\Factory;
    use Suxx\FileHandlers\UploadedFile;
    use Suxx\Http\Request;

    /**
     * @covers  Suxx\Routers\Error404Router
     * @uses    Suxx\Factories\Factory
     * @uses    Suxx\FileHandlers\UploadedFile
     * @uses    Suxx\Http\Request
     */
    class Error404RouterTest extends \PHPUnit_Framework_TestCase
    {
        /**
         * @var \PHPUnit_Framework_MockObject_MockObject | Factory
         */
        private $factory;

        /**
         * @var Error404Router
         */
        private $error404Router;

        /**
         * @var  \PHPUnit_Framework_MockObject_MockObject | UploadedFile
         */
        private $file;

        protected function setUp()
        {
            $this->factory = $this->getMockBuilder(Factory::class)->disableOriginalConstructor()->getMock();
            $this->file = $this->getMockBuilder(UploadedFile::class)->disableOriginalConstructor()->getMock();
            $this->error404Router = new Error404Router($this->factory);
        }

        public function testErrorRouterReturnsRightController()
        {
            $request = new Request(
                ['csrf' => '1234567890'],
                ['REQUEST_URI' => '/invalidUri', 'REQUEST_METHOD' => 'POST'],
                $this->file
            );

            $this->assertInstanceOf(Error404Controller::class, $this->error404Router->route($request));
        }
    }
}
