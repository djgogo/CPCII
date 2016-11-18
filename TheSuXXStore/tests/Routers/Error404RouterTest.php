<?php

class SuxxError404RouterTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var PHPUnit_Framework_MockObject_MockObject | SuxxFactory
     */
    private $factory;

    /**
     * @var SuxxError404Router
     */
    private $error404Router;

    /**
     * @var  PHPUnit_Framework_MockObject_MockObject | SuxxUploadedFile
     */
    private $file;

    protected function setUp()
    {
        $this->factory = $this->getMockBuilder(SuxxFactory::class)->disableOriginalConstructor()->getMock();
        $this->file = $this->getMockBuilder(SuxxUploadedFile::class)->disableOriginalConstructor()->getMock();
        $this->error404Router = new SuxxError404Router($this->factory);
    }

    public function testErrorRouterReturnsRightController()
    {
        $request = new SuxxRequest(
            ['csrf' => '1234567890'],
            ['REQUEST_URI' => '/invalidUri', 'REQUEST_METHOD' => 'POST'],
            $this->file
        );

        $this->assertInstanceOf(Suxx404Controller::class, $this->error404Router->route($request));
    }
}
