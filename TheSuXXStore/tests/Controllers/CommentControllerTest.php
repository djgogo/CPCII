<?php

namespace Suxx\Controllers {

    use Suxx\Http\Request;
    use Suxx\Http\Response;
    use Suxx\Commands\CommentFormCommand;

    /**
     * @covers Suxx\Controllers\CommentController
     * @uses   Suxx\Http\Request
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
         * @var CommentController
         */
        private $commentController;

        protected function setUp()
        {
            $this->request = $this->getMockBuilder(Request::class)->disableOriginalConstructor()->getMock();
            $this->response = $this->getMockBuilder(Response::class)->disableOriginalConstructor()->getMock();
            $this->commentFormCommand = $this->getMockBuilder(CommentFormCommand::class)->disableOriginalConstructor()->getMock();

            $this->commentController = new CommentController($this->commentFormCommand);
        }

        public function testCommentControllerCanBeExecutedAndSetsRedirect()
        {
            $this->commentFormCommand
                ->expects($this->once())
                ->method('execute')
                ->willReturn(true);

            $this->response
                ->expects($this->once())
                ->method('setRedirect')
                ->with('/suxx/product?pid=1');

            $this->request
                ->expects($this->once())
                ->method('getValue')
                ->with('product')
                ->willReturn(1);

            $this->commentController->execute($this->request, $this->response);
        }
    }
}
