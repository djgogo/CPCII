<?php

/**
 * @covers FinanceAndInvestmentCourse
 * @uses AbstractCourse
 * @uses ModuleNameCollection
 */
class FinanceAndInvestmentCourseTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var FinanceAndInvestmentCourse
     */
    private $financeAndInvestmentCourse;

    public function setUp()
    {
        $this->financeAndInvestmentCourse = new FinanceAndInvestmentCourse();
    }

    public function testCorrectModuleEntries()
    {
        $expected = [
            'Credit Risk Management',
            'Energy Markets',
            'Foreign Exchange',
            'Pension Finance',
            'Behavioural Finance',
            'Colloquial English'
        ];

        foreach ($this->financeAndInvestmentCourse->getModuleNames() as $key => $module) {
            $this->assertEquals($expected[$key], $module);
        }
    }

    public function testGetCourseName()
    {
        $this->assertEquals('Finance and Investment', $this->financeAndInvestmentCourse->getCourseName());
    }
}
