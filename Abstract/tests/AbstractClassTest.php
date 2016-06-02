<?php
abstract class AbstractClassTest extends PHPUnit_Framework_TestCase
{
    public function testDoesSomething()
    {
        // Variante 1
        $object = $this->getObject();

        // Variante 2
        $object = $this->getMockForAbstractClass(AbstractClass::class);

        $object->method('doSomethingElse')->willReturn(null);

        $this->assertNull($object->doSomething());
    }

    abstract protected function getObject();
}
