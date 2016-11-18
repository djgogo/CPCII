<?php

/**
 * @covers SuxxRequest
 * @uses SuxxUploadedFile
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
    private $server;

    /**
     * @var SuxxRequest
     */
    private $request;

    /**
     * @var PHPUnit_Framework_MockObject_MockObject | SuxxUploadedFile
     */
    private $file;

    protected function setUp()
    {
        $this->input = [
            'csrf' => '46c2a3deaef22b8d2bd0bff6587a76f916fb2e44',
            'product' => '1',
            'comment' => 'Test Kommentar'
        ];

        $this->server = [
            'REQUEST_URI' => '/suxx/comment',
            'REQUEST_METHOD' => 'POST'
        ];

        $this->file = $this->getMockBuilder(SuxxUploadedFile::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->request = new SuxxRequest($this->input, $this->server, $this->file);
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

    public function testUploadedFileCanBeRetrieved()
    {
        $this->assertInstanceOf(SuxxUploadedFile::class, $this->request->getUploadedFile());
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
