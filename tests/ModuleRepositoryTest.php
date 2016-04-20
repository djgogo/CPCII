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

    public function testGetModuleFromEmptyRepository()
    {
        $this->expectException(RuntimeException::class);
        $this->repository->getModule('Web Development');
    }

    public function testGetModuleFromRepositoryFilledWithOtherModules()
    {
        $this->expectException(RuntimeException::class);

        $this->repository->addModule(new PensionFinance());
        $this->repository->getModule('Web Development');
    }

    public function testAddAndGetModule()
    {
        $this->repository->addModule(new WebDevelopment());
        $webDevelopment = $this->repository->getModule('Web Development');

        $this->assertInstanceOf(WebDevelopment::class, $webDevelopment);
    }

    public function testGetMoreModulesThanAdded()
    {
        $this->expectException(RuntimeException::class);

        $this->repository->addModule(new WebDevelopment());
        $this->repository->getModule('Web Development');
        $this->repository->getModule('Web Development');
    }

    public function testAddAndGetMultipleModules()
    {
        $this->repository->addModule(new WebDevelopment());
        $this->repository->addModule(new WebDevelopment());
        $webDevelopment1 = $this->repository->getModule('Web Development');
        $webDevelopment2 = $this->repository->getModule('Web Development');

        $this->assertNotSame($webDevelopment1, $webDevelopment2);
    }

}
