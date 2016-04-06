<?php


class BurgerConsoleRendererTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var BurgerViewModel
     */
    private $burgerViewModel;

    public function setUp()
    {
        $this->burgerViewModel = new BurgerViewModel('Hamburger', '13.80 €');
    }

    public function testRender()
    {
        $expected = "Hamburger:\n";
        $expected .= "-- Preis: 13.80 €\n";

        $burgerConsoleRenderer = new BurgerConsoleRenderer();

        $this->assertEquals($expected, $burgerConsoleRenderer->render($this->burgerViewModel));
    }

}
