<?php

namespace Suxx\Commands {

    use Suxx\FileHandlers\UploadedFile;
    use Suxx\Forms\FormError;
    use Suxx\Http\Request;
    use Suxx\Http\Session;
    use Suxx\Backends\FileBackend;
    use Suxx\Gateways\CommentTableDataGateway;

    /**
     * @covers Suxx\Commands\CommentFormCommand
     * @uses   Suxx\Http\Session
     * @uses   Suxx\Forms\FormError
     * @uses   Suxx\Backends\FileBackend
     * @uses   Suxx\Http\Request
     * @uses   Suxx\FileHandlers\UploadedFile
     * @uses   Suxx\ValueObjects\FileUpload
     */
    class CommentFormCommandTest extends \PHPUnit_Framework_TestCase
    {
        /**
         * @var Session
         */
        private $session;

        /**
         * @var \PHPUnit_Framework_MockObject_MockObject | FileBackend
         */
        private $backend;

        /**
         * @var FormError
         */
        private $error;

        /**
         * @var \PHPUnit_Framework_MockObject_MockObject | CommentTableDataGateway
         */
        private $dataGateway;

        /**
         * @var \PHPUnit_Framework_MockObject_MockObject | UploadedFile
         */
        private $file;

        /**
         * @var CommentFormCommand
         */
        private $commentFormCommand;

        protected function setUp()
        {
            $this->dataGateway = $this->getMockBuilder(CommentTableDataGateway::class)
                ->disableOriginalConstructor()
                ->getMock();

            $this->file = $this->getMockBuilder(UploadedFile::class)
                ->disableOriginalConstructor()
                ->getMock();

            $this->backend = $this->getMockBuilder(FileBackend::class)
                ->disableOriginalConstructor()
                ->getMock();

            $this->session = new Session(array());
            $this->error = new FormError($this->session);
            $this->commentFormCommand = new CommentFormCommand($this->dataGateway, $this->session, $this->backend, $this->error);
        }

        public function testEmptyFormFieldTriggersError()
        {
            $expectedErrorMessage = 'Bitte geben Sie einen Kommentar ein!';

            $request = ['comment' => 'Test Kommentar', 'picture' => ''];
            $request['comment'] = '';
            $request = new Request($request, array(), $this->file);


            $this->assertFalse($this->commentFormCommand->execute($request));
            $this->assertEquals($expectedErrorMessage, $this->session->getValue('error')->get('comment'));
        }

        public function testInvalidFileCatchesException()
        {
            $expectedErrorMessage = 'Das Bild ist ungültig - Dateiupload konnte nicht ausgeführt werden!';

            $request = $this->getMockBuilder(Request::class)->disableOriginalConstructor()->getMock();

            $request
                ->expects($this->any())
                ->method('getUploadedFile')
                ->willReturn($this->file);

            $this->file
                ->expects($this->once())
                ->method('getFilename')
                ->willReturn('Virus.php');

            $this->assertFalse($this->commentFormCommand->execute($request));
            $this->assertEquals($expectedErrorMessage, $this->session->getValue('error')->get('file'));
        }

        public function testHappyPath()
        {
            $expectedMessage = 'Vielen Dank für Deinen Kommentar';

            $request = ['comment' => 'Test Kommentar', 'product' => 1, 'picture' => ''];
            $request = new Request($request, array(), $this->file);

            $this->dataGateway
                ->expects($this->once())
                ->method('insert')
                ->willReturn(1);

            $this->assertTrue($this->commentFormCommand->execute($request));
            $this->assertEquals($expectedMessage, $this->session->getValue('message'));
        }

        public function testExecutionCanDeleteSessionErrorIfSet()
        {
            $expectedMessage = 'Vielen Dank für Deinen Kommentar';

            $this->session->setValue('error', 'test');

            $request = ['comment' => 'Test Kommentar', 'product' => 1, 'picture' => ''];
            $request = new Request($request, array(), $this->file);

            $this->dataGateway
                ->expects($this->once())
                ->method('insert')
                ->willReturn(1);

            $this->assertTrue($this->commentFormCommand->execute($request));
            $this->assertEquals($expectedMessage, $this->session->getValue('message'));
        }

        public function testCommentCouldNotBeInsertedTriggersWarning()
        {
            $expectedMessage = 'Kommentar fehlgeschlagen!';

            $request = ['comment' => 'Test Kommentar', 'product' => 1, 'picture' => ''];
            $request = new Request($request, array(), $this->file);

            $this->dataGateway
                ->expects($this->once())
                ->method('insert')
                ->willReturn('');

            $this->assertTrue($this->commentFormCommand->execute($request));
            $this->assertEquals($expectedMessage, $this->session->getValue('warning'));
        }

        public function testHappyPathWithUploadedFileCouldBeMoved()
        {
            $files = [
                'picture' => [
                    'name' => 'smiley.jpg',
                    'type' => 'image/jpeg',
                    'tmp_name' => '/var/www/Exercises/TheSuXXStore/tests/TestFiles/smiley',
                    'error' => 0,
                    'size' => 4447
                ]
            ];

            $request = ['comment' => 'Test Kommentar', 'product' => 1, 'picture' => 'smiley.jpg'];
            $request = new Request($request, array(), new UploadedFile($files));

            $this->dataGateway
                ->expects($this->once())
                ->method('insert')
                ->willReturn(1);

            $this->backend
                ->expects($this->once())
                ->method('moveUploadedFileTo');

            $this->assertTrue($this->commentFormCommand->execute($request));
        }
    }
}
