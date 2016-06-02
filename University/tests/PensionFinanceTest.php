<?php

/**
 * @covers PensionFinance
 * @uses Lecturer
 * @uses Module
 */
class PensionFinanceTest extends PHPUnit_Framework_TestCase
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
        $this->assertEquals('Pension Finance', (new PensionFinance($this->lecturer))->getName());
    }

    public function testGetModuleNumber()
    {
        $this->assertEquals(208, (new PensionFinance($this->lecturer))->getModuleNumber());
    }
}
