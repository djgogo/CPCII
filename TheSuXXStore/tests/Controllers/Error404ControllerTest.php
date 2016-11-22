<?php

namespace Suxx\Controllers {

    use Suxx\Http\Request;
    use Suxx\Http\Response;

    /**
     * @covers Suxx\Controllers\Error404Controller
     * @uses   Suxx\Http\Request
     * @uses   Suxx\Http\Response
     */
    class Error404ControllerTest extends \PHPUnit_Framework_TestCase
    {
        /**
         * @var \PHPUnit_Framework_MockObject_MockObject | Request
         */
        private $request;

        /**
         * @var \PHPUnit_Framework_MockObject_MockObject | Response
         */
        private $response;

        public function setUp()
        {
            $this->request = $this->getMockBuilder(Request::class)->disableOriginalConstructor()->getMock();
            $this->response = $this->getMockBuilder(Response::class)->disableOriginalConstructor()->getMock();
        }

        public function testExecutionReturns404template()
        {
            $controller = new Error404Controller();
            $this->assertEquals('404errorview.twig', $controller->execute($this->request, $this->response));
        }
    }
}
