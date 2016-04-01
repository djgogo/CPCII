<?php


class BurgerXmlRenderer implements BurgerRendererInterface
{
    /**
     * @param BurgerViewModel $burgerViewModel
     * @return string
     */
    public function render(BurgerViewModel $burgerViewModel) : string
    {
        $burgerDom = new \TheSeer\fDOM\fDOMDocument();
        $burger = $burgerDom->appendElementNS('http://burger.com/burger', 'burger');
        $burger->appendElement('name', $burgerViewModel->getName());
        $burger->appendElement('price', $burgerViewModel->getPrice());

        return $burgerDom->saveXML();
    }
}