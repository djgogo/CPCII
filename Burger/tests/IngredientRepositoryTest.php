<?php


class IngredientRepositoryTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var IngredientRepository
     */
    private $repository;

    public function setUp()
    {
        $this->repository = new IngredientRepository();
    }

    /**
     * @expectedException RuntimeException
     */
    public function testGetIngredientFromEmptyRepository()
    {
        $this->repository->getIngredient(Cheese::class);
    }

    /**
     * @expectedException RuntimeException
     */
    public function testGetIngredientFromRepositoryFilledWithOtherIngredients()
    {
        $this->repository->addIngredient(new Sauce());
        $this->repository->getIngredient(Cheese::class);
    }

    public function testAddAndGetIngredient()
    {
        $this->repository->addIngredient(new Patty());
        $patty = $this->repository->getIngredient(Patty::class);

        $this->assertInstanceOf(Patty::class, $patty);
    }

    /**
     * @expectedException RuntimeException
     */
    public function testGetMoreIngredientsThanAdded()
    {
        $this->repository->addIngredient(new Patty());
        $this->repository->getIngredient(Patty::class);
        $this->repository->getIngredient(Patty::class);
    }

    public function testAddAndGetMultipleIngredients()
    {
        $this->repository->addIngredient(new Patty());
        $this->repository->addIngredient(new Patty());
        $patty1 = $this->repository->getIngredient(Patty::class);
        $patty2 = $this->repository->getIngredient(Patty::class);

        $this->assertNotSame($patty1, $patty2);
    }
}
