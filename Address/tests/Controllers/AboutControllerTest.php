<?php

namespace Address\Controllers {

    use Address\Http\Request;
    use Address\Http\Response;

    /**
     * @covers Address\Controllers\AboutController
     * @uses Address\Http\Request
     * @uses Address\Http\Response
     */
    class AboutControllerTest extends \PHPUnit_Framework_TestCase
    {
        /** @var Request | \PHPUnit_Framework_MockObject_MockObject */
        private $request;

        /** @var Response | \PHPUnit_Framework_MockObject_MockObject */
        private $response;

        protected function setUp()
        {
            $this->request = $this->getMockBuilder(Request::class)->disableOriginalConstructor()->getMock();
            $this->response = $this->getMockBuilder(Response::class)->disableOriginalConstructor()->getMock();
        }

        public function testExecutionReturnsAboutTemplate()
        {
            $controller = new AboutController();
            $this->assertEquals('about.twig', $controller->execute($this->request, $this->response));
        }
    }
}
