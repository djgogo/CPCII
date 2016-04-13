<?php


abstract class AbstractCourse
{
    public function getModuleNames() : ModuleNameCollection
    {
        $moduleNames = new ModuleNameCollection();

        foreach ($this->getModules() as $module) {
            $moduleNames->add($module);
        }

        return $moduleNames;
    }

    /**
     * @return array
     */
    abstract protected function getModules() : array;

    /**
     * @return string
     */
    abstract public function getCourseName() : string;
}