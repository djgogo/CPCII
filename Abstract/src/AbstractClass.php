<?php
abstract class AbstractClass
{
    public function doSomething()
    {
        return $this->doSomethingElse();
    }
    
    abstract public function doSomethingElse();
}
