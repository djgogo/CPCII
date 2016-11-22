<?php

namespace Suxx\Controllers {

    use Suxx\Http\Request;
    use Suxx\Http\Response;
    use Suxx\Http\Session;

    /**
     * @covers Suxx\Controllers\RegisterViewController
     * @uses   Suxx\Http\Request
     * @uses   Suxx\Http\Response
     * @uses   Suxx\Http\Session
     */
    class RegisterViewControllerTest extends \PHPUnit_Framework_TestCase
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
         * @var RegisterViewController
         */
        private $registerViewController;

        protected function setUp()
        {
            $this->request = $this->getMockBuilder(Request::class)->disableOriginalConstructor()->getMock();
            $this->response = $this->getMockBuilder(Response::class)->disableOriginalConstructor()->getMock();
            $this->session = $this->getMockBuilder(Session::class)->disableOriginalConstructor()->getMock();

            $this->registerViewController = new RegisterViewController($this->session);
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
}
