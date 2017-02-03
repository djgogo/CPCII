<?php

namespace Address\Commands {

    use Address\Exceptions\AddressTableGatewayException;
    use Address\Forms\FormError;
    use Address\Forms\FormPopulate;
    use Address\Gateways\AddressTableDataGateway;
    use Address\Http\Request;
    use Address\Http\Session;
    use Address\ParameterObjects\AddressParameterObject;

    /**
     * @covers Address\Commands\UpdateAddressFormCommand
     * @covers Address\Commands\AbstractFormCommand
     * @uses Address\Gateways\AddressTableDataGateway
     * @uses Address\Http\Session
     * @uses Address\Forms\FormPopulate
     * @uses Address\Forms\FormError
     * @uses Address\Http\Request
     * @uses Address\ValueObjects\Zip
     * @uses Address\ParameterObjects\AddressParameterObject
     * @uses Address\ValueObjects\Id
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

        /** @var \DateTime */
        private $dateTime;

        protected function setUp()
        {
            $this->dataGateway = $this->getMockBuilder(AddressTableDataGateway::class)
                ->disableOriginalConstructor()
                ->getMock();

            $this->session = new Session(array());
            $this->populate = new FormPopulate($this->session);
            $this->error = new FormError($this->session);
            $this->dateTime = new \DateTime();
            $this->updateAddressFormCommand = new UpdateAddressFormCommand(
                $this->session,
                $this->dataGateway,
                $this->populate,
                $this->error,
                $this->dateTime
            );
        }

        /**
         * @dataProvider formFieldProvider
         * @param $field
         * @param $expectedErrorMessage
         */
        public function testEmptyFormFieldsTriggersError(string $field, string $expectedErrorMessage)
        {
            $request = $this->getValidRequestArray();
            $request[$field] = '';
            $request = new Request($request, array());

            $this->assertFalse($this->updateAddressFormCommand->execute($request));
            $this->assertEquals($expectedErrorMessage, $this->session->getValue('error')->get($field));
        }

        public function formFieldProvider()
        {
            return [
                ['address1', 'Bitte geben Sie einen Namen ein.'],
                ['address2', 'Bitte geben Sie eine Addresse ein.'],
                ['city', 'Bitte geben Sie einen Wohnort ein.'],
            ];
        }

        private function getValidRequestArray(): array
        {
            return [
                'id' => 1,
                'address1' => 'Luke Skywalker',
                'address2' => 'Milkyway',
                'city' => 'Galaxy',
                'postalCode' => '1234'
            ];
        }

        public function testInvalidIdCatchesException()
        {
            $expectedErrorMessage = 'Die Address-Id ist ungültig.';
            $request = $this->getValidRequestArray();
            $request['id'] = -1;
            $request = new Request($request, array());

            $this->updateAddressFormCommand->execute($request);
            $this->assertEquals($expectedErrorMessage, $this->error->get('id'));
        }

        public function testInvalidZipCodeCatchesException()
        {
            $expectedErrorMessage = 'Bitte geben Sie eine gültige Postleitzahl ein.';
            $request = $this->getValidRequestArray();
            $request['postalCode'] = 123456;
            $request = new Request($request, array());

            $this->updateAddressFormCommand->execute($request);
            $this->assertEquals($expectedErrorMessage, $this->error->get('postalCode'));
        }

        public function testHappyPath()
        {
            $request = $this->getValidRequestArray();
            $request = new Request($request, array());

            $addressParameter = new AddressParameterObject(
                $request->getValue('id'),
                $request->getValue('address1'),
                $request->getValue('address2'),
                $request->getValue('city'),
                $request->getValue('postalCode'),
                $this->dateTime->format('Y-m-d H:i:s')
            );

            $this->dataGateway
                ->expects($this->once())
                ->method('update')
                ->with($addressParameter)
                ->willReturn(true);

            $this->assertTrue($this->updateAddressFormCommand->execute($request));
            $this->assertEquals('Datensatz wurde geändert', $this->session->getValue('message'));
        }

        public function testExecutionCanDeleteSessionErrorIfSet()
        {
            $this->session->setValue('error', 'test');

            $request = $this->getValidRequestArray();
            $request = new Request($request, array());

            $addressParameter = new AddressParameterObject(
                $request->getValue('id'),
                $request->getValue('address1'),
                $request->getValue('address2'),
                $request->getValue('city'),
                $request->getValue('postalCode'),
                $this->dateTime->format('Y-m-d H:i:s')
            );

            $this->dataGateway
                ->expects($this->once())
                ->method('update')
                ->with($addressParameter)
                ->willReturn(true);

            $this->assertTrue($this->updateAddressFormCommand->execute($request));
            $this->assertEquals('Datensatz wurde geändert', $this->session->getValue('message'));
        }

        public function testIfUpdateAddressFailsTriggersWarningMessage()
        {
            $request = $this->getValidRequestArray();
            $request = new Request($request, array());

            $this->dataGateway
                ->expects($this->once())
                ->method('update')
                ->willThrowException(new AddressTableGatewayException);

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
