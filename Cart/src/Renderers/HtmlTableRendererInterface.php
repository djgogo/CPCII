<?php
declare(strict_types = 1);

namespace Cart\Renderers
{
    interface HtmlTableRendererInterface
    {
        public function getHtml();

        public function startTable();
        public function endTable();

        public function startHead();
        public function endHead();

        public function startBody();
        public function endBody();

        public function startRow();
        public function endRow();

        public function addCell(string $content = '');
    }
}
