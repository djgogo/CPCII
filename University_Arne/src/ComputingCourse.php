<?php
declare(strict_types = 1);


class ComputingCourse extends Course
{
    /**
     * @return string
     */
    public function getName() : string
    {
        return 'Computing programmes';
    }
}