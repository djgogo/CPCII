<?php

namespace Address\Controllers {

    use Address\Http\Request;
    use Address\Http\Response;
    use Address\Commands\UpdateTextFormCommand;
    use Address\Gateways\TextTableDataGateway;
    use Address\Entities\Text;

    /**
     * @covers Address\Controllers\UpdateTextController
     * @uses   Address\Http\Request
     * @uses   Address\Http\Response
     * @uses   Address\Commands\UpdateTextFormCommand
     * @uses   Address\Gateways\TextTableDataGateway
     * @uses   Address\Entities\Text
     */
    class UpdateTextControllerTest extends \PHPUnit_Framework_TestCase
    {
        /** @var Request | \PHPUnit_Framework_MockObject_MockObject */
        private $request;

        /** @var Response | \PHPUnit_Framework_MockObject_MockObject */
        private $response;

        /** @var UpdateTextFormCommand | \PHPUnit_Framework_MockObject_MockObject */
        private $updateTextFormCommand;

        /** @var UpdateTextController */
        private $updateTextController;

        /** @var TextTableDataGateway | \PHPUnit_Framework_MockObject_MockObject */
        private $dataGateway;

        /** @var Text | \PHPUnit_Framework_MockObject_MockObject */
        private $text;

        protected function setUp()
        {
            $this->request = $this->getMockBuilder(Request::class)->disableOriginalConstructor()->getMock();
            $this->response = $this->getMockBuilder(Response::class)->disableOriginalConstructor()->getMock();
            $this->text = $this->getMockBuilder(Text::class)->disableOriginalConstructor()->getMock();
            $this->dataGateway = $this->getMockBuilder(TextTableDataGateway::class)->disableOriginalConstructor()->getMock();
            $this->updateTextFormCommand = $this->getMockBuilder(UpdateTextFormCommand::class)->disableOriginalConstructor()->getMock();

            $this->updateTextController = new UpdateTextController($this->updateTextFormCommand, $this->dataGateway);
        }

        public function testControllerCanBeExecutedAndSetsRightRedirect()
        {
            $this->updateTextFormCommand
                ->expects($this->once())
                ->method('execute')
                ->with($this->request)
                ->willReturn(true);

            $this->response
                ->expects($this->once())
                ->method('setTexts')
                ->with(array($this->text));

            $this->dataGateway
                ->expects($this->once())
                ->method('getAllTexts')
                ->willReturn(array($this->text));

            $this->response
                ->expects($this->once())
                ->method('setRedirect')
                ->with('/text');

            $this->updateTextController->execute($this->request, $this->response);
        }

        public function testControllerRepopulateFormFieldsAndReturnsRightTemplateOnError()
        {
            $this->updateTextFormCommand
                ->expects($this->once())
                ->method('execute')
                ->with($this->request)
                ->willReturn(false);

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

            $this->updateTextFormCommand
                ->expects($this->once())
                ->method('repopulateForm');

            $this->assertEquals('texts/updatetext.twig', $this->updateTextController->execute($this->request, $this->response));
        }
    }
}
