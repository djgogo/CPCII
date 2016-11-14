<?php

/**
 * @covers SuxxRequest
 */
class SuxxRequestTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var array
     */
    private $input;

    /**
     * @var array
     */
    private $files;

    /**
     * @var array
     */
    private $server;

    /**
     * @var SuxxRequest
     */
    private $request;

    protected function setUp()
    {
        $this->input = [
            'csrf' => '46c2a3deaef22b8d2bd0bff6587a76f916fb2e44',
            'product' => '1',
            'comment' => 'Test Kommentar'
        ];

        $this->files = [
            'picture' => [
                'name' => 'smiley.jpg',
                'type' => 'image/jpeg',
                'tmp_name' => '/tmp/phpF7UTQj',
                'error' => 0,
                'size' => 4447
            ]
        ];

        $this->server = [
            'REQUEST_URI' => '/suxx/comment',
            'REQUEST_METHOD' => 'POST'
        ];

        $this->request = new SuxxRequest($this->input, $this->server, $this->files);
    }


    public function testRequestUriCanBeRetrieved()
    {
        $this->assertEquals($this->server['REQUEST_URI'], $this->request->getRequestUri());
    }

    public function testRequestMethodCanBeRetrieved()
    {
        $this->assertEquals($this->server['REQUEST_METHOD'], $this->request->getRequestMethod());
    }

    public function testIsPostRequestReturnsRightBoolean()
    {
        $this->assertTrue($this->request->isPostRequest());
    }

    public function testIsGetRequestReturnsRightBoolean()
    {
        $this->assertFalse($this->request->isGetRequest());
    }

    public function testHasFileReturnsRightBoolean()
    {
        $this->assertTrue($this->request->hasFile('picture'));
    }

    public function testFilenameCanBeRetrieved()
    {
        $this->assertEquals($this->request->getFilename(), $this->request->getFile());
    }

    public function testFilePathCanBeRetrieved()
    {
        $this->assertEquals($this->request->getFilePath(), $this->request->getFilePath());
    }

    public function testValueCanBeRetrieved()
    {
        $this->assertEquals('1', $this->request->getValue('product'));
    }

    public function testValueReturnsNullIfNotFound()
    {
        $this->assertEquals(null, $this->request->getValue('Wrong Key'));
    }

}
