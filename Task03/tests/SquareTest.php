<?php

require_once 'autoload.php';

class SquareTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var float
     */
    private $side;
    /**
     * @var Square
     */
    private $square;
    /**
     * @var float
     */
    private $diagonal;

    public function setUp()
    {
        $this->side = '10';
        $this->square = new Square($this->side);
        $this->diagonal = $this->side * sqrt(2);
    }

    public function testGetDiagonal()
    {
        $this->assertEquals($this->diagonal, $this->square->getDiagonal());
    }

}
