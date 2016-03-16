<?php


/**
 * @covers Dice
 * @uses Color
 */
class DiceTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Color
     */
    private $color;

    /**
     * @var Dice
     */
    private $dice;

    /**
     * @var Color
     */
    private $colors;

    public function setUp()
    {
        $this->color = $this->getMockBuilder(Color::class)->disableOriginalConstructor()->getMock();
        $this->colors = array(
            new Color('Red'),
            new Color('Blue'),
            new Color('Green'),
            new Color('Yellow'),
            new Color('Black'),
            new Color('White'),
        );
        $this->dice = new Dice($this->colors);
    }

    public function testGetColor()
    {
        for ($i=0; $i<5; $i++) {
            $this->assertEquals($this->colors[$i], $this->dice->getColor($i));
        }
    }

    public function testRoll()
    {
        $rolledColor = $this->dice->roll();
        $this->assertInstanceOf(Color::class, $rolledColor);
        $found = false;
        foreach ($this->colors as $color) {
            if ($color === $rolledColor) {
                $found = true;
            }
        }
        $this->assertTrue($found, 'Der Würfel hat eine Farbe zurückgegeben, welche er nicht darf');
    }
}
