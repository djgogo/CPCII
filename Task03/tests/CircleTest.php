<?php

require_once 'autoload.php';

class CircleTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var float
     */
    private $radius;
    /**
     * @var Circle
     */
    private $circle;
    /**
     * @var float
     */
    private $diagonal;
    /**
     * @var float
     */
    private $aera;
    /**
     * @var float
     */
    private $scope;

    public function setUp()
    {
        $this->radius = 10;
        $this->circle = new Circle($this->radius);
        $this->diagonal = $this->radius * 2;
        $this->scope = $this->diagonal * M_PI;
        $this->aera = pow($this->radius,2) * M_PI;
    }

    public function testGetScope()
    {
        $this->assertEquals($this->scope, $this->circle->getScope());
    }

    public function testGetDiagonal()
    {
        $this->assertEquals($this->diagonal, $this->circle->getDiagonal());
    }

    public function testGetAera()
    {
        $this->assertEquals($this->aera, $this->circle->getArea());
    }
}
