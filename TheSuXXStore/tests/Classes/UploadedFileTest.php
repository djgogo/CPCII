<?php

/**
 * @covers SuxxUploadedFile
 */
class SuxxUploadedFileTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var array
     */
    private $files;

    /**
     * @var SuxxUploadedFile
     */
    private $uploadedFile;

    protected function setUp()
    {
        $this->files = [
            'picture' => [
                'name' => 'smiley.jpg',
                'type' => 'image/jpeg',
                'tmp_name' => '/var/www/Exercises/TheSuXXStore/tests/TestFiles/smiley',
                'error' => 0,
                'size' => 4447
            ]
        ];

        $this->uploadedFile = new SuxxUploadedFile($this->files);
    }

    public function testHasFileReturnsRightBoolean()
    {
        $this->assertTrue($this->uploadedFile->hasFile('picture'));
    }

    public function testFilenameCanBeRetrieved()
    {
        $this->assertEquals('smiley.jpg', $this->uploadedFile->getFilename());
    }

    public function testGetFilenameReturnsBlankIfNotSet()
    {
        $uploadedFile = new SuxxUploadedFile(array());
        $this->assertEquals('', $uploadedFile->getFilename());
    }

    public function testFilePathCanBeRetrieved()
    {
        $this->assertEquals('/var/www/Exercises/TheSuXXStore/tests/TestFiles/smiley', $this->uploadedFile->getFilePath());
    }

    public function testSizeCanBeRetrieved()
    {
        $this->assertEquals(4447, $this->uploadedFile->getSize());
    }

    public function testImageSizeCanBeRetrieved()
    {
        $this->assertArrayHasKey('mime', $this->uploadedFile->getImageSize());
    }

    public function testUploadedFileCanBeRetrieved()
    {
        $this->assertInstanceOf(SuxxUploadedFile::class, $this->uploadedFile->getUploadedFile());
    }
}
