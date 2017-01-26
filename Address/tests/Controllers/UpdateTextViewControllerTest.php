<?php

namespace Address\Controllers {

    use Address\Entities\Text;
    use Address\Forms\FormPopulate;
    use Address\Gateways\TextTableDataGateway;
    use Address\Http\Request;
    use Address\Http\Response;
    use Address\Http\Session;

    /**
     * @covers Address\Controllers\UpdateTextViewController
     * @uses Address\Entities\Text
     * @uses Address\Forms\FormPopulate
     * @uses Address\Gateways\TextTableDataGateway
     * @uses Address\Http\Request
     * @uses Address\Http\Response
     * @uses Address\Http\Session
     */
    class UpdateTextViewControllerTest extends \PHPUnit_Framework_TestCase
    {
        /** @var Request | \PHPUnit_Framework_MockObject_MockObject */
        private $request;

        /** @var Response | \PHPUnit_Framework_MockObject_MockObject */
        private $response;

        /** @var Session | \PHPUnit_Framework_MockObject_MockObject */
        private $session;

        /** @var TextTableDataGateway | \PHPUnit_Framework_MockObject_MockObject */
        private $dataGateway;

        /** @var Text | \PHPUnit_Framework_MockObject_MockObject */
        private $text;

        /** @var FormPopulate | \PHPUnit_Framework_MockObject_MockObject */
        private $formPopulate;

        /** @var UpdateTextViewController */
        private $updateTextViewController;

        protected function setUp()
        {
            $this->request = $this->getMockBuilder(Request::class)->disableOriginalConstructor()->getMock();
            $this->response = $this->getMockBuilder(Response::class)->disableOriginalConstructor()->getMock();
            $this->text = $this->getMockBuilder(Text::class)->disableOriginalConstructor()->getMock();
            $this->dataGateway = $this->getMockBuilder(TextTableDataGateway::class)->disableOriginalConstructor()->getMock();
            $this->session = $this->getMockBuilder(Session::class)->disableOriginalConstructor()->getMock();
            $this->formPopulate = $this->getMockBuilder(FormPopulate::class)->disableOriginalConstructor()->getMock();

            $this->updateTextViewController = new UpdateTextViewController($this->session, $this->dataGateway, $this->formPopulate);
        }

        public function testControllerCanBeExecutedAndReturnsRightTemplate()
        {
            $this->response
                ->expects($this->once())
                ->method('setText')
                ->with($this->text);

            $this->dataGateway
                ->expects($this->once())
                ->method('findTextById')
                ->with(1)
                ->willReturn($this->text);

            $this->request
                ->expects($this->once())
                ->method('getValue')
                ->with('id')
                ->willReturn(1);

            $this->formPopulate
                ->expects($this->at(0))
                ->method('set')
                ->with('text1', 'Lorem Ipsum Dolor');

            $this->response
                ->expects($this->exactly(2))
                ->method('getText')
                ->willReturn($this->text);

            $this->text
                ->expects($this->once())
                ->method('getText1')
                ->willReturn('Lorem Ipsum Dolor');

            $this->formPopulate
                ->expects($this->at(1))
                ->method('set')
                ->with('text2', 'Lorem Ipsum Dolor');

            $this->text
                ->expects($this->once())
                ->method('getText2')
                ->willReturn('Lorem Ipsum Dolor');

            $this->session
                ->expects($this->once())
                ->method('isset')
                ->with('error')
                ->willReturn(false);

            $this->assertEquals('texts/updatetext.twig', $this->updateTextViewController->execute($this->request, $this->response));
        }

        public function testSessionErrorCanBeDeleted()
        {
            $this->response
                ->expects($this->once())
                ->method('setText')
                ->with($this->text);

            $this->dataGateway
                ->expects($this->once())
                ->method('findTextById')
                ->with(1)
                ->willReturn($this->text);

            $this->request
                ->expects($this->once())
                ->method('getValue')
                ->with('id')
                ->willReturn(1);

            $this->formPopulate
                ->expects($this->at(0))
                ->method('set')
                ->with('text1', 'Lorem Ipsum Dolor');

            $this->response
                ->expects($this->exactly(2))
                ->method('getText')
                ->willReturn($this->text);

            $this->text
                ->expects($this->once())
                ->method('getText1')
                ->willReturn('Lorem Ipsum Dolor');

            $this->formPopulate
                ->expects($this->at(1))
                ->method('set')
                ->with('text2', 'Lorem Ipsum Dolor');

            $this->text
                ->expects($this->once())
                ->method('getText2')
                ->willReturn('Lorem Ipsum Dolor');

            $this->session
                ->expects($this->once())
                ->method('isset')
                ->with('error')
                ->willReturn(true);

            $this->session
                ->expects($this->once())
                ->method('deleteValue')
                ->with('error');

            $this->assertEquals('texts/updatetext.twig', $this->updateTextViewController->execute($this->request, $this->response));
        }

        public function testIfRequestHasValueIdButItsEmptyReturnsErrorTemplate ()
        {
            $this->request
                ->expects($this->once())
                ->method('hasValue')
                ->with('id')
                ->willReturn(true);

            $this->request
                ->expects($this->once())
                ->method('getValue')
                ->with('id')
                ->willReturn('');

            $this->assertEquals('templates/errors/404.twig', $this->updateTextViewController->execute($this->request, $this->response));
        }
    }
}
