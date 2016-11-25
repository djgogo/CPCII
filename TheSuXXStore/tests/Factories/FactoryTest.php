<?php

namespace Suxx\Factories {

    use Suxx\Http\Session;

    /**
     * @covers Suxx\Factories\Factory
     * @uses Suxx\Http\Session
     * @uses Suxx\Factories\PDOFactory
     * @uses Suxx\Routers\StaticPageRouter
     * @uses Suxx\Routers\PostRequestRouter
     * @uses Suxx\Routers\AuthenticationRouter
     * @uses Suxx\Routers\Error404Router
     * @uses Suxx\Controllers\HomeController
     * @uses Suxx\Controllers\RegisterViewController
     * @uses Suxx\Controllers\RegisterController
     * @uses Suxx\Controllers\LoginViewController
     * @uses Suxx\Controllers\LoginController
     * @uses Suxx\Controllers\ProductController
     * @uses Suxx\Controllers\UpdateProductViewController
     * @uses Suxx\Controllers\UpdateProductController
     * @uses Suxx\Controllers\CommentController
     * @uses Suxx\Controllers\Error404Controller
     * @uses Suxx\Gateways\ProductTableDataGateway
     * @uses Suxx\Gateways\CommentTableDataGateway
     * @uses Suxx\Gateways\UserTableDataGateway
     * @uses Suxx\Commands\CommentFormCommand
     * @uses Suxx\Commands\AuthenticationFormCommand
     * @uses Suxx\Commands\RegistrationFormCommand
     * @uses Suxx\Commands\UpdateProductFormCommand
     * @uses Suxx\Forms\FormError
     * @uses Suxx\Forms\FormPopulate
     * @uses Suxx\Backends\FileBackend
     * @uses Suxx\Authentication\Authenticator
     * @uses Suxx\Authentication\Registrator
     * @uses Suxx\Loggers\ErrorLogger
     */
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

            $this->factory = new Factory($this->pdoFactory, $this->session, 'errorPath');
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
                ['getError500Controller', \Suxx\Controllers\Error500Controller::class],
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
