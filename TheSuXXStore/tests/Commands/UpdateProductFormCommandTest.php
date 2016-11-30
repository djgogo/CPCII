<?php

namespace Suxx\Commands {

    use Suxx\FileHandlers\UploadedFile;
    use Suxx\Forms\FormError;
    use Suxx\Forms\FormPopulate;
    use Suxx\Http\Request;
    use Suxx\Http\Session;
    use Suxx\Gateways\ProductTableDataGateway;

    /**
     * @covers  Suxx\Commands\UpdateProductFormCommand
     * @uses    Suxx\Http\Session
     * @uses    Suxx\Forms\FormError
     * @uses    Suxx\Forms\FormPopulate
     * @uses    Suxx\Http\Request
     * @uses    Suxx\FileHandlers\UploadedFile
     */
    class UpdateProductFormCommandTest extends \PHPUnit_Framework_TestCase
    {
        /**
         * @var Session
         */
        private $session;

        /**
         * @var FormPopulate
         */
        private $populate;

        /**
         * @var FormError
         */
        private $error;

        /**
         * @var \PHPUnit_Framework_MockObject_MockObject | ProductTableDataGateway
         */
        private $dataGateway;

        /**
         * @var \PHPUnit_Framework_MockObject_MockObject | UploadedFile
         */
        private $file;

        /**
         * @var UpdateProductFormCommand
         */
        private $updateProductFormCommand;

        protected function setUp()
        {
            $this->dataGateway = $this->getMockBuilder(ProductTableDataGateway::class)
                ->disableOriginalConstructor()
                ->getMock();

            $this->file = $this->getMockBuilder(UploadedFile::class)
                ->disableOriginalConstructor()
                ->getMock();

            $this->session = new Session(array());
            $this->populate = new FormPopulate($this->session);
            $this->error = new FormError($this->session);
            $this->updateProductFormCommand = new UpdateProductFormCommand($this->dataGateway, $this->session, $this->populate, $this->error);
        }

        /**
         * @dataProvider formFieldProvider
         * @param $field
         * @param $expectedErrorMessage
         */
        public function testEmptyFormFieldTriggersError($field, $expectedErrorMessage)
        {
            $request = ['label' => 'Test Product', 'product-id' => 1, 'price' => '123'];
            $request[$field] = '';
            $request = new Request($request, array(), $this->file);
            $this->assertFalse($this->updateProductFormCommand->execute($request));

            $this->updateProductFormCommand->repopulateForm();
            $this->assertEquals($expectedErrorMessage, $this->session->getValue('error')->get($field));
        }

        public function testHappyPath()
        {
            $request = ['label' => 'Test Product', 'product-id' => 1, 'price' => '123'];
            $request = new Request($request, array(), $this->file);

            $this->dataGateway
                ->expects($this->once())
                ->method('update')
                ->willReturn(true);

            $this->assertTrue($this->updateProductFormCommand->execute($request));
            $this->assertEquals('Datensatz wurde geändert', $this->session->getValue('message'));
        }

        public function testExecutionCanDeleteSessionErrorIfSet()
        {
            $this->session->setValue('error', 'test');

            $request = ['label' => 'Test Product', 'product-id' => 1, 'price' => '123'];
            $request = new Request($request, array(), $this->file);

            $this->dataGateway
                ->expects($this->once())
                ->method('update')
                ->willReturn(true);

            $this->assertTrue($this->updateProductFormCommand->execute($request));
            $this->assertEquals('Datensatz wurde geändert', $this->session->getValue('message'));
        }

        public function testUpdateProductFailsTriggersWarningMessage()
        {
            $request = ['label' => 'Test Product', 'product-id' => 1, 'price' => '123'];
            $request = new Request($request, array(), $this->file);

            $this->dataGateway
                ->expects($this->once())
                ->method('update')
                ->willReturn(false);

            $this->assertTrue($this->updateProductFormCommand->execute($request));
            $this->assertEquals('Aenderung fehlgeschlagen!', $this->session->getValue('warning'));
        }

        public function formFieldProvider() : array
        {
            return [
                ['label', 'Bitte geben Sie einen Label-Text ein!'],
                ['price', 'Bitte geben Sie einen Preis ein!'],
            ];
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

        public function formFieldValuesProvider() : array
        {
            return [
                ['label', 'Test Product'],
                ['price', '123'],
            ];
        }

    }
}
