<?php

class ExampleTest extends PHPUnit_Framework_TestCase
{
    public function testReturnInput()
    {
        $example = new Example;
        $this->assertEquals(2, $example->returnInput(2, true, true, true));
    }

    public function testReturnInputTrueFalseFalse()
    {
        $example = new Example;
        $this->assertEquals(2, $example->returnInput(2, true, false, false));
    }
}

