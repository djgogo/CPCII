<?php

/**
 * @covers Suxx404Controller
 * @uses SuxxRequest
 * @uses SuxxResponse
 */
class Suxx404ControllerTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var PHPUnit_Framework_MockObject_MockObject | SuxxRequest
     */
    private $request;

    /**
     * @var PHPUnit_Framework_MockObject_MockObject | SuxxResponse
     */
    private $response;

    public function setUp()
    {
        $this->request = $this->getMockBuilder(SuxxRequest::class)->disableOriginalConstructor()->getMock();
        $this->response = $this->getMockBuilder(SuxxResponse::class)->disableOriginalConstructor()->getMock();
    }

    public function testExecutionReturns404template()
    {
        $controller = new Suxx404Controller();
        $this->assertEquals('404errorview.twig', $controller->execute($this->request, $this->response));
    }
}
