<?php

namespace Address\Controllers {

    use Address\Http\Request;
    use Address\Http\Response;

    /**
     * @covers Address\Controllers\Error404Controller
     * @uses Address\Http\Request
     * @uses Address\Http\Response
     */
    class Error404ControllerTest extends \PHPUnit_Framework_TestCase
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

        public function testExecutionReturns404template()
        {
            $controller = new Error404Controller();
            $this->assertEquals('/templates/errors/404.twig', $controller->execute($this->request, $this->response));
        }
    }
}
