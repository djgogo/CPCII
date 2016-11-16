<?php

/**
 * @covers SuxxRegisterViewController
 * @uses SuxxRequest
 * @uses SuxxResponse
 * @uses SuxxSession
 */
class SuxxRegisterViewControllerTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var PHPUnit_Framework_MockObject_MockObject | SuxxRequest
     */
    private $request;

    /**
     * @var PHPUnit_Framework_MockObject_MockObject | SuxxResponse
     */
    private $response;

    /**
     * @var PHPUnit_Framework_MockObject_MockObject | SuxxSession
     */
    private $session;

    /**
     * @var SuxxRegisterViewController
     */
    private $registerViewController;

    protected function setUp()
    {
        $this->request = $this->getMockBuilder(SuxxRequest::class)->disableOriginalConstructor()->getMock();
        $this->response = $this->getMockBuilder(SuxxResponse::class)->disableOriginalConstructor()->getMock();
        $this->session = $this->getMockBuilder(SuxxSession::class)->disableOriginalConstructor()->getMock();

        $this->registerViewController = new SuxxRegisterViewController($this->session);
    }

    public function testControllerCanBeExecutedAndReturnsRightTemplate()
    {
        $this->session
            ->expects($this->once())
            ->method('isset')
            ->with('error')
            ->willReturn(false);

        $this->assertEquals('register.twig', $this->registerViewController->execute($this->request, $this->response));
    }

    public function testControllerCanDeleteSessionErrorValue()
    {
        $this->session
            ->expects($this->once())
            ->method('isset')
            ->with('error')
            ->willReturn(true);

        $this->session
            ->expects($this->once())
            ->method('deleteValue')
            ->with('error');

        $this->assertEquals('register.twig', $this->registerViewController->execute($this->request, $this->response));
    }
}
