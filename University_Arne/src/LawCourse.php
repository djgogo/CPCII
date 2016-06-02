<?php
declare(strict_types = 1);


class LawCourse extends Course
{
    /**
     * @return string
     */
    public function getName() : string
    {
        return 'Law';
    }
}