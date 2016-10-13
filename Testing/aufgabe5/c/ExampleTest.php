<?php

class ExampleTest extends PHPUnit_Framework_TestCase
{
    public function testReturnInputPath1()
    {
        $example = new Example;
        $this->assertEquals(2, $example->returnInput(2, false, false, false));
    }

    public function testReturnInputPath2()
    {
        $example = new Example;
        $this->assertEquals(2, $example->returnInput(2, true, false, false));
    }

    public function testReturnInputPath3()
    {
        $example = new Example;
        $this->assertEquals(2, $example->returnInput(2, false, true, false));
    }

    public function testReturnInputPath4()
    {
        $example = new Example;
        $this->assertEquals(2, $example->returnInput(2, false, false, true));
    }
}

