<?php

namespace Address\Commands {

    use Address\Forms\FormError;
    use Address\Forms\FormPopulate;
    use Address\Gateways\TextTableDataGateway;
    use Address\Http\Request;
    use Address\Http\Session;

    /**
     * @covers Address\Commands\UpdateTextFormCommand
     * @uses Address\Gateways\TextTableDataGateway
     * @uses Address\Http\Session
     * @uses Address\Forms\FormPopulate
     * @uses Address\Forms\FormError
     * @uses Address\Http\Request
     * @uses Address\ValueObjects\Zip
     */
    class UpdateTextFormCommandTest extends \PHPUnit_Framework_TestCase
    {
        /** @var TextTableDataGateway | \PHPUnit_Framework_MockObject_MockObject */
        private $dataGateway;

        /** @var Session */
        private $session;

        /** @var FormPopulate */
        private $populate;

        /** @var FormError */
        private $error;

        /** @var UpdateTextFormCommand */
        private $updateTextFormCommand;

        protected function setUp()
        {
            $this->dataGateway = $this->getMockBuilder(TextTableDataGateway::class)
                ->disableOriginalConstructor()
                ->getMock();

            $this->session = new Session(array());
            $this->populate = new FormPopulate($this->session);
            $this->error = new FormError($this->session);
            $this->updateTextFormCommand = new UpdateTextFormCommand($this->dataGateway, $this->session, $this->populate, $this->error);
        }

        /**
         * @dataProvider formFieldProvider
         * @param $field
         * @param $expectedErrorMessage
         */
        public function testEmptyFormFieldsTriggersError($field, $expectedErrorMessage)
        {
            $request = ['id' => '1', 'text1' => 'Lorem ipsum dolor', 'text2' => 'Lorem ipsum dolor'];
            $request[$field] = '';
            $request = new Request($request, array());
            $this->assertFalse($this->updateTextFormCommand->execute($request));

            $this->updateTextFormCommand->repopulateForm();
            $this->assertEquals($expectedErrorMessage, $this->session->getValue('error')->get($field));
        }

        public function formFieldProvider()
        {
            return [
                ['text1', 'Bitte geben Sie einen Text ein.'],
                ['text2', 'Bitte geben Sie einen Text ein.']
            ];
        }

        public function testHappyPath()
        {
            $request = ['id' => '1', 'text1' => 'Lorem ipsum dolor', 'text2' => 'Lorem ipsum dolor'];
            $request = new Request($request, array());

            $this->dataGateway
                ->expects($this->once())
                ->method('update')
                ->willReturn(true);

            $this->assertTrue($this->updateTextFormCommand->execute($request));
            $this->assertEquals('Datensatz wurde geändert', $this->session->getValue('message'));
        }

        public function testExecutionCanDeleteSessionErrorIfSet()
        {
            $this->session->setValue('error', 'test');

            $request = ['id' => '1', 'text1' => 'Lorem ipsum dolor', 'text2' => 'Lorem ipsum dolor'];
            $request = new Request($request, array());

            $this->dataGateway
                ->expects($this->once())
                ->method('update')
                ->willReturn(true);

            $this->assertTrue($this->updateTextFormCommand->execute($request));
            $this->assertEquals('Datensatz wurde geändert', $this->session->getValue('message'));
        }

        public function testUpdateAddressFailsTriggersWarningMessage()
        {
            $request = ['id' => '1', 'text1' => 'Lorem ipsum dolor', 'text2' => 'Lorem ipsum dolor'];
            $request = new Request($request, array());

            $this->dataGateway
                ->expects($this->once())
                ->method('update')
                ->willReturn(false);

            $this->assertTrue($this->updateTextFormCommand->execute($request));
            $this->assertEquals('Aenderung fehlgeschlagen!', $this->session->getValue('warning'));
        }

        /**
         * @dataProvider formFieldValuesProvider
         * @param $fieldName
         * @param $fieldValue
         */
        public function testFormFieldsCanBeRepopulated($fieldName, $fieldValue)
        {
            $this->populate->set($fieldName, $fieldValue);
            $this->assertSame($fieldValue, $this->session->getValue('populate')->get($fieldName));
        }

        public function formFieldValuesProvider()
        {
            return [
                ['text1', 'Lorem ipsum dolor'],
                ['text2', 'Lorem ipsum dolor']
            ];
        }
    }
}
