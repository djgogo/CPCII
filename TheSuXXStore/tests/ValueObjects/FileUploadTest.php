<?php

namespace Suxx\ValueObjects {

    use Suxx\Exceptions\InvalidUploadedFileException;
    use Suxx\FileHandlers\UploadedFile;

    /**
     * @covers  Suxx\ValueObjects\FileUpload
     * @uses    Suxx\FileHandlers\UploadedFile
     */
    class FileUploadTest extends \PHPUnit_Framework_TestCase
    {
        public function testFileUploadValueObjectCanBeCreatedWithValidParameters()
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

            $this->assertInstanceOf(FileUpload::class, new FileUpload(new UploadedFile($files)));
        }

        public function testInvalidFileThrowsException()
        {
            $this->expectException(InvalidUploadedFileException::class);

            $files = [
                'picture' => [
                    'name' => 'ImAnAttacker.php',
                    'type' => 'text/html',
                    'tmp_name' => '/var/www/Exercises/TheSuXXStore/tests/TestFiles/ImAnAttacker.php',
                    'error' => 0,
                    'size' => 100
                ]
            ];

            new FileUpload(new UploadedFile($files));
        }

        public function testFileUploadThrowsExceptionIfUploadedFileIsToBig()
        {
            $this->expectException(InvalidUploadedFileException::class);

            $files = [
                'picture' => [
                    'name' => 'smiley.jpg',
                    'type' => 'image/jpeg',
                    'tmp_name' => '/var/www/Exercises/TheSuXXStore/tests/TestFiles/smiley',
                    'error' => 0,
                    'size' => 500001
                ]
            ];

            new FileUpload(new UploadedFile($files));
        }

        public function testFileUploadThrowsExceptionIfFileHasInvalidMimeType()
        {
            $this->expectException(InvalidUploadedFileException::class);

            $files = [
                'picture' => [
                    'name' => 'smiley.jpg',
                    'type' => 'application/javascript',
                    'tmp_name' => '/var/www/Exercises/TheSuXXStore/tests/TestFiles/smiley',
                    'error' => 0,
                    'size' => 2000
                ]
            ];

            new FileUpload(new UploadedFile($files));
        }
    }
}
