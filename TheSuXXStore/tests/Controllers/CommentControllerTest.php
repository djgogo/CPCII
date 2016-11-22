<?php

namespace Suxx\Controllers {

    use Suxx\Http\Request;
    use Suxx\Http\Response;
    use Suxx\Http\Session;
    use Suxx\Commands\CommentFormCommand;

    /**
     * @covers Suxx\Controllers\CommentController
     * @uses   Suxx\Http\Request
     * @uses   Suxx\Http\Session
     * @uses   Suxx\Http\Response
     * @uses   Suxx\Commands\CommentFormCommand
     */
    class CommentControllerTest extends \PHPUnit_Framework_TestCase
    {
        /**
         * @var \PHPUnit_Framework_MockObject_MockObject | Request
         */
        private $request;

        /**
         * @var \PHPUnit_Framework_MockObject_MockObject | Response
         */
        private $response;

        /**
         * @var \PHPUnit_Framework_MockObject_MockObject | CommentFormCommand
         */
        private $commentFormCommand;

        /**
         * @var \PHPUnit_Framework_MockObject_MockObject | Session
         */
        private $session;

        /**
         * @var CommentController
         */
        private $commentController;

        protected function setUp()
        {
            $this->request = $this->getMockBuilder(Request::class)->disableOriginalConstructor()->getMock();
            $this->response = $this->getMockBuilder(Response::class)->disableOriginalConstructor()->getMock();
            $this->session = $this->getMockBuilder(Session::class)->disableOriginalConstructor()->getMock();
            $this->commentFormCommand = $this->getMockBuilder(CommentFormCommand::class)->disableOriginalConstructor()->getMock();

            $this->commentController = new CommentController($this->session, $this->commentFormCommand);
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
}
