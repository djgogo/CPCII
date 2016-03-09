<?php

require_once 'autoload.php';

class RectangleTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var float
     */
    private $aSide;
    /**
     * @var float
     */
    private $bSide;
    /**
     * @var Rectangle
     */
    private $rectangle;
    /**
     * @var float
     */
    private $diagonal;
    /**
     * @var float
     */
    private $scope;
    /**
     * @var float
     */
    private $aera;

    public function setUp()
    {
        $this->aSide = '26';
        $this->bSide = '14';
        $this->rectangle = new Rectangle($this->aSide, $this->bSide);
        $this->diagonal = sqrt(pow($this->aSide,2) + pow($this->bSide,2));
        $this->scope = ($this->aSide + $this->bSide) * 2;
        $this->aera = $this->aSide * $this->bSide;
    }

    public function testGetScope()
    {
        $this->assertEquals($this->scope, $this->rectangle->getScope());
    }

    public function testGetDiagonal()
    {
        $this->assertEquals($this->diagonal, $this->rectangle->getDiagonal());
    }

    public function testGetAera()
    {
        $this->assertEquals($this->aera, $this->rectangle->getArea());
    }
}
