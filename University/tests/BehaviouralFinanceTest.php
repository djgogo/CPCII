<?php

/**
 * @covers BehaviouralFinance
 * @uses Lecturer
 * @uses Module
 */
class BehaviouralFinanceTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Lecturer
     */
    private $lecturer;

    public function setUp()
    {
        $this->lecturer = $this->getMockBuilder(Lecturer::class)
            ->disableOriginalConstructor()
            ->getMock();
    }

    public function testGetName()
    {
        $this->assertEquals('Behavioural Finance', (new BehaviouralFinance($this->lecturer))->getName());
    }

    public function testGetModuleNumber()
    {
        $this->assertEquals(220, (new BehaviouralFinance($this->lecturer))->getModuleNumber());
    }
}
