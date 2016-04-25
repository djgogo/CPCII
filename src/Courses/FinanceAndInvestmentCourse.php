<?php


class FinanceAndInvestmentCourse extends AbstractCourse
{
    /**
     * @return array
     */
    protected function getModules() : array
    {
        return [
            'Credit Risk Management',
            'Energy Markets',
            'Foreign Exchange',
            'Pension Finance',
            'Behavioural Finance',
            'Colloquial English'
        ];
    }

    /**
     * @return string
     */
    public function getCourseName() : string
    {
        return 'Finance and Investment';
    }
}