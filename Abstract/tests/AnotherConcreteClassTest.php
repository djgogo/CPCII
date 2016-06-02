<?php
class AnotherConcreteClassTest extends AbstractClassTest
{
    public function testDoesSomethingElse()
    {
        $o = new AnotherConcreteClass;

        $this->assertNull($o->doSomethingElse());
    }

    protected function getObject()
    {
        return new AnotherConcreteClass;
    }
}
