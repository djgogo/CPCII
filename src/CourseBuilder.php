<?php


class CourseBuilder
{
    /**
     * @var ModuleRepository
     */
    private $moduleRepository;

    /**
     * @param ModuleRepository $moduleRepository
     */
    public function __construct(ModuleRepository $moduleRepository)
    {
        $this->moduleRepository = $moduleRepository;
    }

    /**
     * @param AbstractCourse $abstractCourse
     * @return Course
     */
    public function build(AbstractCourse $abstractCourse)
    {
        $moduleNameCollection = $abstractCourse->getModuleNames();

        if (!$moduleNameCollection->hasModules()) {
            throw new RuntimeException('No Modules in Collection List, can not build the Course');
        }

        $modules = [];

        foreach ($moduleNameCollection as $module) {
            $modules[] = $this->moduleRepository->getModule($module);
        }

        return new Course($abstractCourse->getCourseName(), ...$modules);
    }
}