<?php

/**
 * @covers ModuleRepository
 * @uses Lecturer
 * @uses Module
 * @uses PensionFinance
 * @uses WebDevelopment
 */
class ModuleRepositoryTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var ModuleRepository
     */
    private $repository;
    /**
     * @var Lecturer
     */
    private $lecturer;

    public function setUp()
    {
        $this->lecturer = $this->getMockBuilder(Lecturer::class)
            ->disableOriginalConstructor()
            ->getMock();

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

        $this->repository->addModule(new PensionFinance($this->lecturer));
        $this->repository->getModule('Web Development');
    }

    public function testAddAndGetModule()
    {
        $this->repository->addModule(new WebDevelopment($this->lecturer));
        $webDevelopment = $this->repository->getModule('Web Development');

        $this->assertInstanceOf(WebDevelopment::class, $webDevelopment);
    }

    public function testGetMoreModulesThanAdded()
    {
        $this->expectException(RuntimeException::class);

        $this->repository->addModule(new WebDevelopment($this->lecturer));
        $this->repository->getModule('Web Development');
        $this->repository->getModule('Web Development');
    }

    public function testAddAndGetMultipleModules()
    {
        $this->repository->addModule(new WebDevelopment($this->lecturer));
        $this->repository->addModule(new WebDevelopment($this->lecturer));
        $webDevelopment1 = $this->repository->getModule('Web Development');
        $webDevelopment2 = $this->repository->getModule('Web Development');

        $this->assertNotSame($webDevelopment1, $webDevelopment2);
    }

}
