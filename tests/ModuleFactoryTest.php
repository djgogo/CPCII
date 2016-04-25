<?php

/**
 * @covers ModuleFactory
 * @uses Lecturer
 * @uses Module
 */
class ModuleFactoryTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var ModuleFactory
     */
    private $factory;
    /**
     * @var Lecturer
     */
    private $lecturer;

    public function setUp()
    {
        $this->lecturer = $this->getMockBuilder(Lecturer::class)
            ->disableOriginalConstructor()
            ->getMock();

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
            call_user_func_array(array($this->factory, $method), array($this->lecturer))
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
