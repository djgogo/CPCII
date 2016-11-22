<?php

namespace Suxx\Backends
{
    use Suxx\Exceptions\InvalidFileBackendException;

    $calledSource = null;
    $calledDestination = null;

    function move_uploaded_file($source, $destination)
    {
        global $calledSource;
        global $calledDestination;
        $calledSource = $source;
        $calledDestination = $destination;
    }

    /**
     * @covers Suxx\Backends\FileBackend
     */
    class FileBackendTest extends \PHPUnit_Framework_TestCase
    {
        /**
         * @var FileBackend
         */
        private $fileBackend;

        protected function setUp()
        {
            $this->fileBackend = new FileBackend();
        }

        public function testFileCanBeMovedToTargetDestination()
        {
            global $calledSource;
            global $calledDestination;
            $source = '/tmp/source.txt';
            $destination = '/tmp/destination.txt';

            $this->fileBackend->moveUploadedFileTo($source, $destination);

            $this->assertSame($calledSource, $source);
            $this->assertSame($calledDestination, $destination);
        }

        public function testDirectoryCanBeCheckedIfExists()
        {
            $this->assertTrue($this->fileBackend->directoryExists(__DIR__ . '/../../html/images/Comments/'));
            $this->assertFalse($this->fileBackend->directoryExists('/any/path'));
        }

        public function testIfDirectoryDoesNotExistsThrowsException()
        {
            $this->expectException(InvalidFileBackendException::class);

            $source = '/tmp/source.txt';
            $destination = '/wrongDirectory';

            $this->fileBackend->moveUploadedFileTo($source, $destination);
        }
    }

}
