<?php

namespace Address\Commands {

    use Address\Forms\FormError;
    use Address\Forms\FormPopulate;
    use Address\Gateways\AddressTableDataGateway;
    use Address\Http\Request;
    use Address\Http\Session;

    /**
     * @covers Address\Commands\UpdateAddressFormCommand
     * @uses Address\Gateways\AddressTableDataGateway
     * @uses Address\Http\Session
     * @uses Address\Forms\FormPopulate
     * @uses Address\Forms\FormError
     * @uses Address\Http\Request
     * @uses Address\ValueObjects\Zip
     */
    class UpdateAddressFormCommandTest extends \PHPUnit_Framework_TestCase
    {
        /** @var AddressTableDataGateway | \PHPUnit_Framework_MockObject_MockObject */
        private $dataGateway;

        /** @var Session */
        private $session;

        /** @var FormPopulate */
        private $populate;

        /** @var FormError */
        private $error;

        /** @var UpdateAddressFormCommand */
        private $updateAddressFormCommand;

        protected function setUp()
        {
            $this->dataGateway = $this->getMockBuilder(AddressTableDataGateway::class)
                ->disableOriginalConstructor()
                ->getMock();

            $this->session = new Session(array());
            $this->populate = new FormPopulate($this->session);
            $this->error = new FormError($this->session);
            $this->updateAddressFormCommand = new UpdateAddressFormCommand($this->dataGateway, $this->session, $this->populate, $this->error);
        }

        /**
         * @dataProvider formFieldProvider
         * @param $field
         * @param $expectedErrorMessage
         */
        public function testEmptyFormFieldsTriggersError(string $field, string $expectedErrorMessage)
        {
            $request = [
                'id' => 1,
                'address1' => 'Luke Skywalker',
                'address2' => 'Milkyway',
                'city' => 'Galaxy',
                'postalCode' => '1234'
            ];
            $request[$field] = '';
            $request = new Request($request, array());
            $this->assertFalse($this->updateAddressFormCommand->execute($request));

            $this->updateAddressFormCommand->repopulateForm();
            $this->assertEquals($expectedErrorMessage, $this->session->getValue('error')->get($field));
        }

        public function formFieldProvider()
        {
            return [
                ['address1', 'Bitte geben Sie einen Namen ein.'],
                ['address2', 'Bitte geben Sie eine Addresse ein.'],
                ['city', 'Bitte geben Sie einen Wohnort ein.'],
                ['postalCode', 'Bitte geben Sie eine gültige Postleitzahl ein.'],
            ];
        }

        public function testHappyPath()
        {
            $request = [
                'id' => 1,
                'address1' => 'Luke Skywalker',
                'address2' => 'Milkyway',
                'city' => 'Galaxy',
                'postalCode' => '1234'
            ];
            $request = new Request($request, array());

            $this->dataGateway
                ->expects($this->once())
                ->method('update')
                ->willReturn(true);

            $this->assertTrue($this->updateAddressFormCommand->execute($request));
            $this->assertEquals('Datensatz wurde geändert', $this->session->getValue('message'));
        }

        public function testExecutionCanDeleteSessionErrorIfSet()
        {
            $this->session->setValue('error', 'test');

            $request = [
                'id' => 1,
                'address1' => 'Luke Skywalker',
                'address2' => 'Milkyway',
                'city' => 'Galaxy',
                'postalCode' => '1234'
            ];
            $request = new Request($request, array());

            $this->dataGateway
                ->expects($this->once())
                ->method('update')
                ->willReturn(true);

            $this->assertTrue($this->updateAddressFormCommand->execute($request));
            $this->assertEquals('Datensatz wurde geändert', $this->session->getValue('message'));
        }

        public function testUpdateAddressFailsTriggersWarningMessage()
        {
            $request = [
                'id' => 1,
                'address1' => 'Luke Skywalker',
                'address2' => 'Milkyway',
                'city' => 'Galaxy',
                'postalCode' => '1234'
            ];
            $request = new Request($request, array());

            $this->dataGateway
                ->expects($this->once())
                ->method('update')
                ->willReturn(false);

            $this->assertTrue($this->updateAddressFormCommand->execute($request));
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
                ['address1', 'Luke Skywalker'],
                ['address2', 'Miklyway'],
                ['city', 'Galaxy'],
                ['postalCode', '1234']
            ];
        }
    }
}
