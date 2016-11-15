<?php

/**
 * @covers SuxxUpdateProductFormCommand
 * @uses SuxxSession
 * @uses SuxxFormError
 * @uses SuxxFormPopulate
 * @uses SuxxRequest
 */
class SuxxUpdateProductFormCommandTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var SuxxSession
     */
    private $session;

    /**
     * @var SuxxFormPopulate
     */
    private $populate;

    /**
     * @var SuxxFormError
     */
    private $error;

    /**
     * @var PHPUnit_Framework_MockObject_MockObject | SuxxProductTableDataGateway
     */
    private $dataGateway;

    /**
     * @var PHPUnit_Framework_MockObject_MockObject | SuxxUploadedFile
     */
    private $file;

    protected function setUp()
    {
        $this->dataGateway = $this->getMockBuilder(SuxxProductTableDataGateway::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->file = $this->getMockBuilder(SuxxUploadedFile::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->session = new SuxxSession(array());
        $this->populate = new SuxxFormPopulate($this->session);
        $this->error = new SuxxFormError($this->session);
    }

    /**
     * @dataProvider formFieldProvider
     * @param $field
     * @param $expectedErrorMessage
     */
    public function testEmptyFormFieldTriggersError($field, $expectedErrorMessage)
    {
        $request = ['label' => 'Test Product', 'price' => '123'];
        $request[$field] = '';
        $request = new SuxxRequest($request, array(), $this->file);

        $updateProductFormCommand = new SuxxUpdateProductFormCommand($this->dataGateway, $this->session, $this->populate, $this->error);
        $this->assertFalse($updateProductFormCommand->execute($request));
        $this->assertEquals($expectedErrorMessage, $this->session->getValue('error')->get($field));
    }

    public function testHappyPath()
    {
        $request = ['label' => 'Test Product', 'price' => '123'];
        $request = new SuxxRequest($request, array(), $this->file);

        $this->dataGateway
            ->expects($this->once())
            ->method('update')
            ->willReturn(true);

        $updateProductFormCommand = new SuxxUpdateProductFormCommand($this->dataGateway, $this->session, $this->populate, $this->error);
        $this->assertTrue($updateProductFormCommand->execute($request));
        $this->assertEquals('Datensatz wurde geändert', $this->session->getValue('message'));
    }

    public function testUpdateProductFailsTriggersWarningMessage()
    {
        $request = ['label' => 'Test Product', 'price' => '123'];
        $request = new SuxxRequest($request, array(), $this->file);

        $this->dataGateway
            ->expects($this->once())
            ->method('update')
            ->willReturn(false);

        $updateProductFormCommand = new SuxxUpdateProductFormCommand($this->dataGateway, $this->session, $this->populate, $this->error);
        $this->assertTrue($updateProductFormCommand->execute($request));
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
