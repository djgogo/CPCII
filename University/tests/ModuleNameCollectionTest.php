<?php

/**
 * @covers ModuleNameCollection
 */
class ModuleNameCollectionTest extends PHPUnit_Framework_TestCase
{
    private $module1;
    private $module2;

    public function setUp()
    {
        $this->module1 = 'Mathematics';

        $this->module2 = 'Physics';
    }

    public function testAddAndRetrieveModules()
    {
        $collection = new ModuleNameCollection();

        $collection->add($this->module1);
        $collection->add($this->module2);

        $expected = [$this->module1, $this->module2];

        foreach ($collection as $key => $module) {
            $this->assertEquals($expected[$key], $module);
        }
    }

    public function testHasModules()
    {
        $collection = new ModuleNameCollection();

        $this->assertFalse($collection->hasModules());

        $collection->add($this->module1);

        $this->assertTrue($collection->hasModules());

        $collection->add($this->module2);

        $this->assertTrue($collection->hasModules());
    }
}
