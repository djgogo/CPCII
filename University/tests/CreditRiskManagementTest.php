<?php

/**
 * @covers CreditRiskManagement
 * @uses Lecturer
 * @uses Module
 */
class CreditRiskManagementTest extends PHPUnit_Framework_TestCase
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
        $this->assertEquals('Credit Risk Management', (new CreditRiskManagement($this->lecturer))->getName());
    }

    public function testGetModuleNumber()
    {
        $this->assertEquals(200, (new CreditRiskManagement($this->lecturer))->getModuleNumber());
    }
}
