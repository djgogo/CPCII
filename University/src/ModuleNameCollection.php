<?php


class ModuleNameCollection implements Iterator
{
    /**
     * @var array
     */
    private $modules = [];

    /**
     * @param string $modules
     */
    public function add($modules)
    {
        $this->modules[] = $modules;
    }

    /**
     * @return boolean
     */
    public function hasModules() : bool
    {
        return count($this->modules) > 0;
    }

    public function current()
    {
        return current($this->modules);
    }

    public function next()
    {
        return next($this->modules);
    }

    public function key()
    {
        return key($this->modules);
    }

    public function valid()
    {
        return is_string(current($this->modules));
    }

    public function rewind()
    {
        return reset($this->modules);
    }
}