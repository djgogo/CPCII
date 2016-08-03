<?php
declare(strict_types = 1);

namespace Cart\Renderers
{
    class CartAsHtmlTableRenderer extends HtmlTableRenderer
    {
        public function renderHtmlTop()
        {
            $this->addDocType();
            $this->startHtml();
            $this->startHead();
            $this->addMetaTag();
            $this->addTitle('Cart');
            $this->endHead();
            $this->startBody();
            $this->startTable();
            $this->startRow();
            $this->addTableHeader('Name');
            $this->addTableHeader('Anzahl');
            $this->addTableHeader('Einzel-Preis');
            $this->addTableHeader('Gesamt-Preis');
            $this->endRow();
        }

        public function renderHTMLBottom()
        {
            $this->endTable();
            $this->endBody();
            $this->endHtml();
        }

        public function renderRow(string $name, string $quantity, string $unitPrice, string $price)
        {
            $this->startRow();
                $this->addCell($name);
                $this->addCell($quantity);
                $this->addCell($unitPrice);
                $this->addCell($price);
            $this->endRow();
        }

        public function renderTotal(string $total)
        {
            $this->startRow();
                $this->addCell($total);
            $this->endRow();
        }
    }
}
