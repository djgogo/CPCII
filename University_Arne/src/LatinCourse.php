<?php
declare(strict_types = 1);


class LatinCourse extends Course
{
    /**
     * @return string
     */
    public function getName() : string
    {
        return 'Latin';
    }
}