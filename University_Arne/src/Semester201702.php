<?php
declare(strict_types = 1);

class Semester201702 extends AbstractSemester
{
    /**
     * @return string
     */
    public function getName() : string
    {
        return '2017-02';
    }

    /**
     * @return Course[]
     */
    protected function createCourses() : array
    {
        return [
            new LawCourse(),
            new MathematicsCourse(),
            new LatinCourse()
        ];
    }
}