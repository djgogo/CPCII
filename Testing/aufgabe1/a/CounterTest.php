<?php
declare(strict_types = 1);

/**
 * @covers Counter
 */
class CounterTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Counter
     */
    private $counter;

    public function setUp()
    {
        $this->counter = new Counter();
    }

    public function testCounterCanBeIncrementedOnes()
    {
        $this->assertEquals(1, $this->counter->next());
    }

    public function testCounterCanBeIncrementedTwice()
    {
        $this->assertEquals(1, $this->counter->next());
        $this->assertEquals(2, $this->counter->next());
    }
}
