<?php

namespace Suxx\Factories {

    use Suxx\Http\Session;

    class FactoryTest extends \PHPUnit_Framework_TestCase
    {
        /**
         * @var \PHPUnit_Framework_MockObject_MockObject | PDOFactory
         */
        private $pdoFactory;

        /**
         * @var \PHPUnit_Framework_MockObject_MockObject | Session
         */
        private $session;

        /**
         * @var Factory
         */
        private $factory;

        protected function setUp()
        {
            $this->pdoFactory = $this->getMockBuilder(PDOFactory::class)->disableOriginalConstructor()->getMock();
            $this->session = $this->getMockBuilder(Session::class)->disableOriginalConstructor()->getMock();

            $this->factory = new Factory($this->pdoFactory, $this->session);
        }

        public function testDatabaseCanBeRetrieved()
        {
            $this->assertInstanceOf(\PDO::class, $this->factory->getDatabase());
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
                [0, \Suxx\Routers\StaticPageRouter::class],
                [1, \Suxx\Routers\PostRequestRouter::class],
                [2, \Suxx\Routers\AuthenticationRouter::class],
                [3, \Suxx\Routers\Error404Router::class],
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
                ['getHomeController', \Suxx\Controllers\HomeController::class],
                ['getRegisterViewController', \Suxx\Controllers\RegisterViewController::class],
                ['getRegisterController', \Suxx\Controllers\RegisterController::class],
                ['getLoginViewController', \Suxx\Controllers\LoginViewController::class],
                ['getLoginController', \Suxx\Controllers\LoginController::class],
                ['getLogoutController', \Suxx\Controllers\LogoutController::class],
                ['getProductController', \Suxx\Controllers\ProductController::class],
                ['getUpdateProductViewController', \Suxx\Controllers\UpdateProductViewController::class],
                ['getUpdateProductController', \Suxx\Controllers\UpdateProductController::class],
                ['getCommentController', \Suxx\Controllers\CommentController::class],
                ['getError404Controller', \Suxx\Controllers\Error404Controller::class],
                ['getProductTableGateway', \Suxx\Gateways\ProductTableDataGateway::class],
                ['getCommentTableGateway', \Suxx\Gateways\CommentTableDataGateway::class],
                ['getUserTableGateway', \Suxx\Gateways\UserTableDataGateway::class],
                ['getCommentFormCommand', \Suxx\Commands\CommentFormCommand::class],
                ['getAuthenticationFormCommand', \Suxx\Commands\AuthenticationFormCommand::class],
                ['getRegistrationFormCommand', \Suxx\Commands\RegistrationFormCommand::class],
                ['getUpdateProductFormCommand', \Suxx\Commands\UpdateProductFormCommand::class],
                ['getFormError', \Suxx\Forms\FormError::class],
                ['getFormPopulate', \Suxx\Forms\FormPopulate::class],
                ['getFileBackend', \Suxx\Backends\FileBackend::class],
            ];
        }
    }
}
