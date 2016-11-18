<?php

namespace Suxx {

    $isCalled = false;
    function session_regenerate_id()
    {
        global $isCalled;
        $isCalled = true;
    }

    /**
     * @covers \Suxx\SuxxLoginController
     * @uses   SuxxRequest
     * @uses   SuxxResponse
     * @uses   SuxxSession
     * @uses   SuxxAuthenticationFormCommand
     */
    class SuxxLoginControllerTest extends \PHPUnit_Framework_TestCase
    {
        /**
         * @var \PHPUnit_Framework_MockObject_MockObject | \SuxxRequest
         */
        private $request;

        /**
         * @var \PHPUnit_Framework_MockObject_MockObject | \SuxxResponse
         */
        private $response;

        /**
         * @var \PHPUnit_Framework_MockObject_MockObject | \SuxxSession
         */
        private $session;

        /**
         * @var \PHPUnit_Framework_MockObject_MockObject | \SuxxAuthenticationFormCommand
         */
        private $authenticationFormCommand;

        /**
         * @var \Suxx\SuxxLoginController
         */
        private $loginController;

        protected function setUp()
        {
            $this->request = $this->getMockBuilder(\SuxxRequest::class)->disableOriginalConstructor()->getMock();
            $this->response = $this->getMockBuilder(\SuxxResponse::class)->disableOriginalConstructor()->getMock();
            $this->session = $this->getMockBuilder(\SuxxSession::class)->disableOriginalConstructor()->getMock();
            $this->authenticationFormCommand = $this->getMockBuilder(\SuxxAuthenticationFormCommand::class)->disableOriginalConstructor()->getMock();

            $this->loginController = new SuxxLoginController($this->session, $this->authenticationFormCommand);
        }

        public function testControllerCanBeExecutedAndSetsRightRedirect()
        {
            $this->authenticationFormCommand
                ->expects($this->once())
                ->method('execute')
                ->with($this->request)
                ->willReturn(true);

            $this->session
                ->expects($this->once())
                ->method('getSessionData')
                ->willReturn(array());

            $this->response
                ->expects($this->once())
                ->method('setRedirect')
                ->with('/');

            $this->loginController->execute($this->request, $this->response);
        }

        public function testControllerReturnsRightTemplateOnError()
        {
            $this->authenticationFormCommand
                ->expects($this->once())
                ->method('execute')
                ->with($this->request)
                ->willReturn(false);

            $this->assertEquals('login.twig', $this->loginController->execute($this->request, $this->response));
        }
    }
}
