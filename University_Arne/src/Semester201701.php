<?php
declare(strict_types = 1);

class Semester201701 extends AbstractSemester
{
    /**
     * @return string
     */
    public function getName() : string
    {
        return '2017-01';
    }

    protected function createCourses() : array
    {
        return [
            new ComputingCourse(),
            new PhysicsCourse(),
            new PsychologyCourse()
        ];
    }
}