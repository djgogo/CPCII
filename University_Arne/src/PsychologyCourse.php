<?php
declare(strict_types = 1);


class PsychologyCourse extends Course
{
    /**
     * @return string
     */
    public function getName() : string
    {
       return 'Psychology';
    }
}