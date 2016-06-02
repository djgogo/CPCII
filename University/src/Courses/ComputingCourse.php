<?php


class ComputingCourse extends AbstractCourse
{
    /**
     * @return array
     */
    protected function getModules() : array
    {
        return [
            'Entity Relationship Modelling',
            'Web Development',
            'Database Systems',
            'First Level Support',
            'Network Infrastructure',
            'Colloquial English'
        ];
    }

    /**
     * @return string
     */
    public function getCourseName() : string
    {
        return 'Computing programmes';
    }
}