<?php


class ModuleFactoryTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var ModuleFactory
     */
    private $factory;

    public function setUp()
    {
        $this->factory = new ModuleFactory();
    }

    /**
     * @dataProvider provideModules
     * @param $className
     */
    public function testCreateModuleWorks($className)
    {
        $method = 'create' . $className . 'Module';

        $this->assertInstanceOf(
            $className,
            call_user_func(array($this->factory, $method))
        );
    }

    public function provideModules()
    {
        return [
            [EntityRelationshipModelling::class],
            [WebDevelopment::class],
            [DatabaseSystems::class],
            [FirstLevelSupport::class],
            [NetworkInfrastructure::class],
            [CreditRiskManagement::class],
            [EnergyMarkets::class],
            [ForeignExchange::class],
            [PensionFinance::class],
            [BehaviouralFinance::class],
            [ColloquialEnglish::class]
        ];
    }
}
