<?php

use Fancy\SuxxFileBackend;

/**
 * @covers SuxxCommentFormCommand
 * @uses SuxxSession
 * @uses SuxxFormError
 * @uses \Fancy\SuxxFileBackend
 * @uses SuxxRequest
 * @uses SuxxUploadedFile
 * @uses SuxxFileUpload
 */
class SuxxCommentFormCommandTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var SuxxSession
     */
    private $session;

    /**
     * @var \Fancy\SuxxFileBackend
     */
    private $backend;

    /**
     * @var SuxxFormError
     */
    private $error;

    /**
     * @var PHPUnit_Framework_MockObject_MockObject | SuxxCommentTableDataGateway
     */
    private $dataGateway;

    /**
     * @var PHPUnit_Framework_MockObject_MockObject | SuxxUploadedFile
     */
    private $file;

    protected function setUp()
    {
        $this->dataGateway = $this->getMockBuilder(SuxxCommentTableDataGateway::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->file = $this->getMockBuilder(SuxxUploadedFile::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->session = new SuxxSession(array());
        $this->backend = new SuxxFileBackend();
        $this->error = new SuxxFormError($this->session);
    }

    public function testEmptyFormFieldTriggersError()
    {
        $expectedErrorMessage = 'Bitte geben Sie einen Kommentar ein!';

        $request = ['comment' => 'Test Kommentar', 'picture' => ''];
        $request['comment'] = '';
        $request = new SuxxRequest($request, array(), $this->file);

        $commentFormCommand = new SuxxCommentFormCommand($this->dataGateway, $this->session, $this->backend, $this->error);
        $this->assertFalse($commentFormCommand->execute($request));
        $this->assertEquals($expectedErrorMessage, $this->session->getValue('error')->get('comment'));
    }

    public function testInvalidFileCatchesException()
    {
        $expectedErrorMessage = 'Das Bild ist ungültig - Dateiupload konnte nicht ausgeführt werden!';

        $request = $this->getMockBuilder(SuxxRequest::class)->disableOriginalConstructor()->getMock();

        $request
            ->expects($this->any())
            ->method('getUploadedFile')
            ->willReturn($this->file);

        $this->file
            ->expects($this->once())
            ->method('getFilename')
            ->willReturn('Virus.php');

        $commentFormCommand = new SuxxCommentFormCommand($this->dataGateway, $this->session, $this->backend, $this->error);
        $this->assertFalse($commentFormCommand->execute($request));
        $this->assertEquals($expectedErrorMessage, $this->session->getValue('error')->get('file'));
    }

    public function testHappyPath()
    {
        $expectedMessage = 'Vielen Dank für Deinen Kommentar';

        $request = ['comment' => 'Test Kommentar', 'picture' => ''];
        $request = new SuxxRequest($request, array(), $this->file);

        $this->dataGateway
            ->expects($this->once())
            ->method('insert')
            ->willReturn(1);

        $commentFormCommand = new SuxxCommentFormCommand($this->dataGateway, $this->session, $this->backend, $this->error);
        $this->assertTrue($commentFormCommand->execute($request));
        $this->assertEquals($expectedMessage, $this->session->getValue('message'));
    }

    public function testExecutionCanDeleteSessionErrorIfSet()
    {
        $expectedMessage = 'Vielen Dank für Deinen Kommentar';

        $this->session->setValue('error', 'test');

        $request = ['comment' => 'Test Kommentar', 'picture' => ''];
        $request = new SuxxRequest($request, array(), $this->file);

        $this->dataGateway
            ->expects($this->once())
            ->method('insert')
            ->willReturn(1);

        $commentFormCommand = new SuxxCommentFormCommand($this->dataGateway, $this->session, $this->backend, $this->error);
        $this->assertTrue($commentFormCommand->execute($request));
        $this->assertEquals($expectedMessage, $this->session->getValue('message'));
    }

    public function testCommentCouldNotBeInsertedTriggersWarning()
    {
        $expectedMessage = 'Kommentar fehlgeschlagen!';

        $request = ['comment' => 'Test Kommentar', 'picture' => ''];
        $request = new SuxxRequest($request, array(), $this->file);

        $this->dataGateway
            ->expects($this->once())
            ->method('insert')
            ->willReturn('');

        $commentFormCommand = new SuxxCommentFormCommand($this->dataGateway, $this->session, $this->backend, $this->error);
        $this->assertTrue($commentFormCommand->execute($request));
        $this->assertEquals($expectedMessage, $this->session->getValue('warning'));
    }

}
