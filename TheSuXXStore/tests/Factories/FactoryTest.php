<?php

class SuxxFactoryTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var PHPUnit_Framework_MockObject_MockObject | PDOFactory
     */
    private $pdoFactory;

    /**
     * @var PHPUnit_Framework_MockObject_MockObject | SuxxSession
     */
    private $session;

    /**
     * @var SuxxFactory
     */
    private $factory;

    protected function setUp()
    {
        $this->pdoFactory = $this->getMockBuilder(PDOFactory::class)->disableOriginalConstructor()->getMock();
        $this->session = $this->getMockBuilder(SuxxSession::class)->disableOriginalConstructor()->getMock();
        
        $this->factory = new SuxxFactory($this->pdoFactory, $this->session);
    }

    public function testDatabaseCanBeRetrieved()
    {
        $this->assertInstanceOf(PDO::class, $this->factory->getDatabase());
    }

    /**
     * @dataProvider provideRouterNames
     * @param $router
     * @param $instance
     */
    public function testRoutersCanBeRetrieved($router, $instance)
    {
        $this->assertInstanceOf($instance, $this->factory->getRouters()[$router]);
    }

    public function provideRouterNames()
    {
        return [
            [0, SuxxStaticPageRouter::class],
            [1, SuxxPostRequestRouter::class],
            [2, SuxxAuthenticationRouter::class],
            [3, SuxxError404Router::class],
        ];
    }

    /**
     * @dataProvider provideInstanceNames
     * @param $method
     * @param $instance
     */
    public function testInstancesCanBeCreated($method, $instance)
    {
        $this->assertInstanceOf($instance, call_user_func_array(array($this->factory, $method), []));
    }

    public function provideInstanceNames()
    {
        return [
            ['getHomeController', SuxxHomeController::class],
            ['getRegisterViewController', SuxxRegisterViewController::class],
            ['getRegisterController', SuxxRegisterController::class],
            ['getLoginViewController', SuxxLoginViewController::class],
            ['getLoginController', \Suxx\SuxxLoginController::class],
            ['getLogoutController', SuxxLogoutController::class],
            ['getProductController', SuxxProductController::class],
            ['getUpdateProductViewController', SuxxUpdateProductViewController::class],
            ['getUpdateProductController', SuxxUpdateProductController::class],
            ['getCommentController', SuxxCommentController::class],
            ['get404Controller', Suxx404Controller::class],
            ['getProductTableGateway', SuxxProductTableDataGateway::class],
            ['getCommentTableGateway', SuxxCommentTableDataGateway::class],
            ['getUserTableGateway', SuxxUserTableDataGateway::class],
            ['getCommentFormCommand', SuxxCommentFormCommand::class],
            ['getAuthenticationFormCommand', SuxxAuthenticationFormCommand::class],
            ['getRegistrationFormCommand', SuxxRegistrationFormCommand::class],
            ['getUpdateProductFormCommand', SuxxUpdateProductFormCommand::class],
            ['getFormError', SuxxFormError::class],
            ['getFormPopulate', SuxxFormPopulate::class],
            ['getFileBackend', \Fancy\SuxxFileBackend::class],
        ];
    }
}
