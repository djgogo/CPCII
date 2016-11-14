<?php

/**
 * @covers SuxxFileBackend
 */
class SuxxFileBackendTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var SuxxFileBackend
     */
    private $fileBackend;

    protected function setUp()
    {
        $this->fileBackend = new SuxxFileBackend();
    }

    //TODO testFileCanBeMovedToTargetDestination
//    public function testFileCanBeMovedToTargetDestination()
//    {
//
//    }

    public function testDirectoryCanBeCheckedIfExists()
    {
        $this->assertTrue($this->fileBackend->directoryExists(__DIR__ . '/../../html/images/Comments/'));
        $this->assertFalse($this->fileBackend->directoryExists('/any/path'));
    }
}
