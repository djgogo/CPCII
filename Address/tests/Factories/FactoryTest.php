<?php

namespace Address\Factories {

    use Address\Http\Session;

    /**
     * @covers Address\Factories\Factory
     * @uses Address\Http\Session
     * @uses Address\Controllers\HomeController
     * @uses Address\Controllers\AboutController
     * @uses Address\Controllers\UpdateAddressViewController
     * @uses Address\Controllers\UpdateAddressController
     * @uses Address\Controllers\DeleteAddressController
     * @uses Address\Controllers\Error404Controller
     * @uses Address\Controllers\Error500Controller
     * @uses Address\Gateways\AddressTableDataGateway
     * @uses Address\Commands\UpdateAddressFormCommand
     * @uses Address\Forms\FormError
     * @uses Address\Forms\FormPopulate
     * @uses Address\Loggers\ErrorLogger
     * @uses Address\Routers\GetRequestRouter
     * @uses Address\Routers\PostRequestRouter
     * @uses Address\Routers\Error404Router
     * @uses Address\Commands\AbstractFormCommand
     */
    class FactoryTest extends \PHPUnit_Framework_TestCase
    {
        /**
         * @var PDOFactory | \PHPUnit_Framework_MockObject_MockObject
         */
        private $pdoFactory;

        /**
         * @var Session | \PHPUnit_Framework_MockObject_MockObject
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

            $this->factory = new Factory($this->session, $this->pdoFactory, 'errorPath');
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
                [0, \Address\Routers\GetRequestRouter::class],
                [1, \Address\Routers\PostRequestRouter::class],
                [2, \Address\Routers\Error404Router::class]
            ];
        }

        /**
         * @dataProvider provideInstanceNames
         * @param $method
         * @param $instance
         */
        public function testInstancesCanBeCreated($method, $instance)
        {
            $this->assertInstanceOf($instance, call_user_func_array([$this->factory, $method], []));
        }

        public function provideInstanceNames()
        {
            return [
                ['getHomeController', \Address\Controllers\HomeController::class],
                ['getAboutController', \Address\Controllers\AboutController::class],
                ['getUpdateAddressViewController', \Address\Controllers\UpdateAddressViewController::class],
                ['getUpdateAddressController', \Address\Controllers\UpdateAddressController::class],
                ['getDeleteAddressController', \Address\Controllers\DeleteAddressController::class],
                ['getError404Controller', \Address\Controllers\Error404Controller::class],
                ['getError500Controller', \Address\Controllers\Error500Controller::class],
                ['getAddressTableGateway', \Address\Gateways\AddressTableDataGateway::class],
                ['getUpdateAddressFormCommand', \Address\Commands\UpdateAddressFormCommand::class],
                ['getFormError', \Address\Forms\FormError::class],
                ['getFormPopulate', \Address\Forms\FormPopulate::class],
                ['getErrorLogger', \Address\Loggers\ErrorLogger::class],
            ];
        }
    }
}
