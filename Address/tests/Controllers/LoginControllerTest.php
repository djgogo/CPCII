<?php

namespace Address\Controllers {

    use Address\Http\Request;
    use Address\Http\Response;
    use Address\Commands\AuthenticationFormCommand;

    $isCalled = false;
    function session_regenerate_id()
    {
        global $isCalled;
        $isCalled = true;
    }

    /**
     * @covers Address\Controllers\LoginController
     * @uses   Address\Http\Request
     * @uses   Address\Http\Response
     * @uses   Address\Commands\AuthenticationFormCommand
     */
    class LoginControllerTest extends \PHPUnit_Framework_TestCase
    {
        /** @var Request | \PHPUnit_Framework_MockObject_MockObject */
        private $request;

        /** @var Response | \PHPUnit_Framework_MockObject_MockObject */
        private $response;

        /** @var AuthenticationFormCommand | \PHPUnit_Framework_MockObject_MockObject */
        private $authenticationFormCommand;

        /** @var LoginController */
        private $loginController;

        protected function setUp()
        {
            $this->request = $this->getMockBuilder(Request::class)->disableOriginalConstructor()->getMock();
            $this->response = $this->getMockBuilder(Response::class)->disableOriginalConstructor()->getMock();
            $this->authenticationFormCommand = $this->getMockBuilder(AuthenticationFormCommand::class)->disableOriginalConstructor()->getMock();

            $this->loginController = new LoginController($this->authenticationFormCommand);
        }

        public function testControllerCanBeExecutedAndSetsRightRedirect()
        {
            global $isCalled;

            $this->authenticationFormCommand
                ->expects($this->once())
                ->method('execute')
                ->with($this->request)
                ->willReturn(true);

            $this->response
                ->expects($this->once())
                ->method('setRedirect')
                ->with('/');

            $this->loginController->execute($this->request, $this->response);
            $this->assertTrue($isCalled);
        }

        public function testControllerReturnsRightTemplateIfExecutionFails()
        {
            global $isCalled;

            $this->authenticationFormCommand
                ->expects($this->once())
                ->method('execute')
                ->with($this->request)
                ->willReturn(false);

            $this->assertEquals('authentication/login.twig', $this->loginController->execute($this->request, $this->response));
            $this->assertTrue($isCalled);
        }
    }
}
