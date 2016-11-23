<?php

namespace Suxx\Controllers {

    use Suxx\Http\Request;
    use Suxx\Http\Response;
    use Suxx\Http\Session;
    use Suxx\Commands\AuthenticationFormCommand;

    $isCalled = false;
    function session_regenerate_id()
    {
        global $isCalled;
        $isCalled = true;
    }

    /**
     * @covers Suxx\Controllers\LoginController
     * @uses   Suxx\Http\Request
     * @uses   Suxx\Http\Response
     * @uses   Suxx\Http\Session
     * @uses   Suxx\Commands\AuthenticationFormCommand
     */
    class LoginControllerTest extends \PHPUnit_Framework_TestCase
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
         * @var \PHPUnit_Framework_MockObject_MockObject | Session
         */
        private $session;

        /**
         * @var \PHPUnit_Framework_MockObject_MockObject | AuthenticationFormCommand
         */
        private $authenticationFormCommand;

        /**
         * @var LoginController
         */
        private $loginController;

        protected function setUp()
        {
            $this->request = $this->getMockBuilder(Request::class)->disableOriginalConstructor()->getMock();
            $this->response = $this->getMockBuilder(Response::class)->disableOriginalConstructor()->getMock();
            $this->session = $this->getMockBuilder(Session::class)->disableOriginalConstructor()->getMock();
            $this->authenticationFormCommand = $this->getMockBuilder(AuthenticationFormCommand::class)->disableOriginalConstructor()->getMock();

            $this->loginController = new LoginController($this->session, $this->authenticationFormCommand);
        }

        public function testControllerCanBeExecutedAndSetsRightRedirect()
        {
            global $isCalled;

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
            $this->assertTrue($isCalled);
        }

        public function testControllerReturnsRightTemplateOnError()
        {
            global $isCalled;

            $this->authenticationFormCommand
                ->expects($this->once())
                ->method('execute')
                ->with($this->request)
                ->willReturn(false);

            $this->assertEquals('login.twig', $this->loginController->execute($this->request, $this->response));
            $this->assertTrue($isCalled);
        }
    }
}
