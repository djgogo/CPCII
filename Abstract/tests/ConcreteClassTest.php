<?php
class ConcreteClassTest extends AbstractClassTest
{
    public function testDoesSomethingElse()
    {
        $o = new ConcreteClass;

        $this->assertNull($o->doSomethingElse());
    }

    protected function getObject()
    {
        return new ConcreteClass;
    }
}
