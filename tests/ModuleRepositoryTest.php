<?php


class ModuleRepositoryTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var ModuleRepository
     */
    private $repository;

    public function setUp()
    {
        $this->repository = new ModuleRepository();
    }

//    /**
//     * @expectedException RuntimeException
//     */
//    public function testGetModuleFromEmptyRepository()
//    {
//        $this->repository->getModule(WebDevelopment::class);
//    }

//    /**
//     * @expectedException RuntimeException
//     */
//    public function testGetModuleFromRepositoryFilledWithOtherModules()
//    {
//        $this->repository->addModule(new PensionFinance());
//        $this->repository->getModule(WebDevelopment::class);
//    }
}
