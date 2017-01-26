<?php

namespace Address\Controllers {

    use Address\Gateways\TextTableDataGateway;
    use Address\Http\Request;
    use Address\Http\Response;
    use Address\Http\Session;

    /**
     * @covers Address\Controllers\TextController
     * @uses Address\Gateways\TextTableDataGateway
     * @uses Address\Http\Request
     * @uses Address\Http\Response
     * @uses Address\Http\Session
     */
    class TextControllerTest extends \PHPUnit_Framework_TestCase
    {
        /** @var Request | \PHPUnit_Framework_MockObject_MockObject */
        private $request;

        /** @var Response | \PHPUnit_Framework_MockObject_MockObject */
        private $response;

        /** @var Session | \PHPUnit_Framework_MockObject_MockObject */
        private $session;

        /** @var TextTableDataGateway | \PHPUnit_Framework_MockObject_MockObject */
        private $dataGateway;

        /** @var TextController */
        private $textController;

        protected function setUp()
        {
            $this->request = $this->getMockBuilder(Request::class)->disableOriginalConstructor()->getMock();
            $this->response = $this->getMockBuilder(Response::class)->disableOriginalConstructor()->getMock();
            $this->session = $this->getMockBuilder(Session::class)->disableOriginalConstructor()->getMock();
            $this->dataGateway = $this->getMockBuilder(TextTableDataGateway::class)->disableOriginalConstructor()->getMock();

            $this->textController = new TextController($this->session, $this->dataGateway);
        }

        public function testDefaultCaseCanBeExecutedAndReturnsTextTemplate()
        {
            $this->request
                ->expects($this->at(0))
                ->method('hasValue')
                ->with('sort')
                ->willReturn(false);

            $this->request
                ->expects($this->at(1))
                ->method('hasValue')
                ->with('searchText')
                ->willReturn(false);

            $this->response
                ->expects($this->once())
                ->method('setTexts');

            $this->dataGateway
                ->expects($this->once())
                ->method('getAllTexts')
                ->willReturn(array());

            $this->session
                ->expects($this->once())
                ->method('setValue')
                ->with('sort', '');

            $this->assertEquals('text.twig', $this->textController->execute($this->request, $this->response));
        }

        public function testSortAscendingCanBeExecuted()
        {
            $this->request
                ->expects($this->at(0))
                ->method('hasValue')
                ->with('sort')
                ->willReturn(true);

            $this->request
                ->expects($this->once())
                ->method('getValue')
                ->with('sort')
                ->willReturn('ASC');

            $this->response
                ->expects($this->once())
                ->method('setTexts');

            $this->dataGateway
                ->expects($this->once())
                ->method('getAllTextsOrderedByUpdatedAscending')
                ->willReturn(array());

            $this->session
                ->expects($this->once())
                ->method('setValue')
                ->with('sort', 'ASC');

            $this->assertEquals('text.twig', $this->textController->execute($this->request, $this->response));
        }

        public function testSortDescendingCanBeExecuted()
        {
            $this->request
                ->expects($this->at(0))
                ->method('hasValue')
                ->with('sort')
                ->willReturn(true);

            $this->request
                ->expects($this->exactly(2))
                ->method('getValue')
                ->with('sort')
                ->willReturn('DESC');

            $this->response
                ->expects($this->once())
                ->method('setTexts');

            $this->dataGateway
                ->expects($this->once())
                ->method('getAllTextsOrderedByUpdatedDescending')
                ->willReturn(array());

            $this->session
                ->expects($this->once())
                ->method('setValue')
                ->with('sort', 'DESC');

            $this->assertEquals('text.twig', $this->textController->execute($this->request, $this->response));
        }

        public function testExecutionWithSearchValueWorks()
        {
            $this->request
                ->expects($this->at(0))
                ->method('hasValue')
                ->with('sort')
                ->willReturn(false);

            $this->response
                ->expects($this->at(0))
                ->method('setTexts');

            $this->dataGateway
                ->expects($this->once())
                ->method('getAllTexts')
                ->willReturn(array());

            $this->session
                ->expects($this->once())
                ->method('setValue')
                ->with('sort', '');

            $this->request
                ->expects($this->at(1))
                ->method('hasValue')
                ->with('searchText')
                ->willReturn(true);

            $this->response
                ->expects($this->at(1))
                ->method('setTexts');

            $this->dataGateway
                ->expects($this->once())
                ->method('getSearchedText')
                ->willReturn(array());

            $this->request
                ->expects($this->at(2))
                ->method('getValue')
                ->with('searchText')
                ->willReturn('search String');

            $this->assertEquals('text.twig', $this->textController->execute($this->request, $this->response));
        }

    }
}
