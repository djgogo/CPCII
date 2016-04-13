<?php

/**
 * @covers ModuleNumber
 */
class ModuleNumberTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var int
     */
    private $moduleNumber;

    public function setUp()
    {
        $this->moduleNumber = new ModuleNumber(123);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testModuleNumberIsNotBiggerThanZeroThrowsException()
    {
        new ModuleNumber(-1);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testModuleNumberHasTheRightLengthThrowsException()
    {
        new ModuleNumber(1234);
    }

    public function testModuleNumberConversionToString()
    {
        $this->assertEquals('123', (string)$this->moduleNumber);
    }

}
