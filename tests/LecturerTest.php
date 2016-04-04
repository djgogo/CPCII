<?php


class LecturerTest extends PHPUnit_Framework_TestCase
{
    public function testGetGetStuffIdWorks()
    {
        $newId = new StuffId(1);
        $lecturer = new Lecturer($newId);
        $this->assertEquals($newId, $lecturer->getStuffId());
    }
}
