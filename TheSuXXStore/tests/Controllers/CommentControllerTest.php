<?php

/**
 * @covers SuxxCommentController
 * @uses SuxxRequest
 * @uses SuxxResponse
 */
class SuxxCommentControllerTest extends PHPUnit_Framework_TestCase
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
     * @var PHPUnit_Framework_MockObject_MockObject | SuxxCommentFormCommand
     */
    private $commentFormCommand;

    /**
     * @var PHPUnit_Framework_MockObject_MockObject | SuxxSession
     */
    private $session;

    /**
     * @var SuxxCommentController
     */
    private $commentController;

    protected function setUp()
    {
        $this->request = $this->getMockBuilder(SuxxRequest::class)->disableOriginalConstructor()->getMock();
        $this->response = $this->getMockBuilder(SuxxResponse::class)->disableOriginalConstructor()->getMock();
        $this->session = $this->getMockBuilder(SuxxSession::class)->disableOriginalConstructor()->getMock();
        $this->commentFormCommand = $this->getMockBuilder(SuxxCommentFormCommand::class)->disableOriginalConstructor()->getMock();

        $this->commentController = new SuxxCommentController($this->session, $this->commentFormCommand);
    }

    /**
     * @runInSeparateProcess
     */
    public function testCommentControllerCanBeExecutedAndSendsHeader()
    {
        $this->commentFormCommand
            ->expects($this->once())
            ->method('execute')
            ->willReturn(true);

        $this->session
            ->expects($this->once())
            ->method('getSessionData');

        $this->commentController->execute($this->request, $this->response);
        $this->assertContains('Location: /suxx/product?pid=', xdebug_get_headers());
    }

    /**
     * @runInSeparateProcess
     */
    public function testCommentControllerSendsLocationHeaderOnError()
    {
        $this->commentFormCommand
            ->expects($this->once())
            ->method('execute')
            ->willReturn(false);

        $this->commentController->execute($this->request, $this->response);
        $this->assertContains('Location: /suxx/product?pid=', xdebug_get_headers());
    }
}
