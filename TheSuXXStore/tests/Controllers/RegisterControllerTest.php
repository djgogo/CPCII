<?php

/**
 * @covers SuxxRegisterController
 * @uses SuxxRequest
 * @uses SuxxResponse
 * @uses SuxxRegistrationFormCommand
 * @uses SuxxProductTableDataGateway
 */
class SuxxRegisterControllerTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var PHPUnit_Framework_MockObject_MockObject | SuxxRequest
     */
    private $request;

    /**
     * @var PHPUnit_Framework_MockObject_MockObject | SuxxResponse
     */
    private $response;

    /**
     * @var PHPUnit_Framework_MockObject_MockObject | SuxxRegistrationFormCommand
     */
    private $registrationFormCommand;

    /**
     * @var SuxxRegisterController
     */
    private $registerController;

    /**
     * @var PHPUnit_Framework_MockObject_MockObject | SuxxProductTableDataGateway
     */
    private $productDataGateway;


    protected function setUp()
    {
        $this->request = $this->getMockBuilder(SuxxRequest::class)->disableOriginalConstructor()->getMock();
        $this->response = $this->getMockBuilder(SuxxResponse::class)->disableOriginalConstructor()->getMock();
        $this->productDataGateway = $this->getMockBuilder(SuxxProductTableDataGateway::class)->disableOriginalConstructor()->getMock();
        $this->registrationFormCommand = $this->getMockBuilder(SuxxRegistrationFormCommand::class)->disableOriginalConstructor()->getMock();

        $this->registerController = new SuxxRegisterController($this->registrationFormCommand, $this->productDataGateway);
    }

    public function testControllerCanBeExecutedAndReturnsRightTemplate()
    {
        $this->registrationFormCommand
            ->expects($this->once())
            ->method('execute')
            ->with($this->request)
            ->willReturn(true);

        $this->response
            ->expects($this->once())
            ->method('setProducts')
            ->with(array());

        $this->productDataGateway
            ->expects($this->once())
            ->method('getAllProducts')
            ->willReturn(array());

        $this->assertEquals('base.twig', $this->registerController->execute($this->request, $this->response));
    }

    public function testControllerReturnsRightTemplateOnError()
    {
        $this->registrationFormCommand
            ->expects($this->once())
            ->method('execute')
            ->with($this->request)
            ->willReturn(false);

        $this->assertEquals('register.twig', $this->registerController->execute($this->request, $this->response));
    }
}
