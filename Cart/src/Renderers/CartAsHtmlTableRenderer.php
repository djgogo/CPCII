<?php
declare(strict_types = 1);

namespace Cart\Renderers
{
    use Cart\Cart;
    use Cart\EuroFormatter;

    class CartAsHtmlTableRenderer
    {
        /**
         * @var HtmlTableRenderer
         */
        private $renderer;

        /**
         * @var EuroFormatter
         */
        private $euroFormatter;

        public function __construct(HtmlTableRenderer $htmlTableRenderer, EuroFormatter $euroFormatter)
        {
            $this->renderer = $htmlTableRenderer;
            $this->euroFormatter = $euroFormatter;
        }

        public function render(Cart $cart)
        {
            $this->renderHtmlTop();

            foreach ($cart->getIterator() as $item) {
                 $this->renderRow(
                     $item->getName(),
                     (string) $item->getQuantity(),
                     $this->euroFormatter->format($item->getUnitPrice()),
                     $this->euroFormatter->format($item->getPrice())
                 );
            }

            if ($cart->getVoucher() !== null) {
                $this->renderVoucher(
                    $cart->getVoucher()->getName(),
                    '1',
                    sprintf("%d%%", $cart->getVoucher()->getReduction())
                    );
            }

            $this->renderHTMLBottom();

            $this->renderTotal(
                'Total: ______________________',
                $this->euroFormatter->format($cart->getTotal())
            );
        }

        private function renderHtmlTop()
        {
            $this->renderer->addDocType();
            $this->renderer->startHtml();
            $this->renderer->startHead();
                $this->renderer->addMetaTag();
                $this->renderer->addTitle('Cart');
            $this->renderer->endHead();
            $this->renderer->startBody();
                $this->renderer->startTable();
                $this->renderer->startRow();
                    $this->renderer->addTableHeader('Name');
                    $this->renderer->addTableHeader('Anzahl');
                    $this->renderer->addTableHeader('Einzel-Preis');
                    $this->renderer->addTableHeader('Gesamt-Preis');
                $this->renderer->endRow();
        }

        private function renderHTMLBottom()
        {
                $this->renderer->endTable();
            $this->renderer->endBody();
            $this->renderer->endHtml();
        }

        private function renderRow(string $name, string $quantity, string $unitPrice, string $price)
        {
            $this->renderer->startRow();
                $this->renderer->addCell($name);
                $this->renderer->addCell($quantity);
                $this->renderer->addCell($unitPrice);
                $this->renderer->addCell($price);
            $this->renderer->endRow();
        }

        private function renderVoucher(string $name, string $quantity, string $reduction)
        {
            $this->renderer->startRow();
                $this->renderer->addCell($name);
                $this->renderer->addCell($quantity);
                $this->renderer->addCell($reduction);
            $this->renderer->endRow();
        }

        private function renderTotal(string $name, string $total)
        {
            $this->renderer->startRow();
                $this->renderer->addCell($name);
                $this->renderer->addCell($total);
            $this->renderer->endRow();
        }
    }
}
