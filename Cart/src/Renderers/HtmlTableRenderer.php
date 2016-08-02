<?php
declare(strict_types = 1);

namespace Cart\Renderers
{
    class HtmlTableRenderer implements HtmlTableRendererInterface
    {
        private $html = '';

        public function getHtml() : string
        {
            return $this->html;
        }

        public function startTable()
        {
            $this->html .= '<table>';
        }

        public function endTable()
        {
            $this->html .= '</table>';
        }

        public function startHead()
        {
            $this->html .= '<head>';
        }

        public function endHead()
        {
            $this->html .= '</head>';
        }

        public function startBody()
        {
            $this->html .= '<body>';
        }

        public function endBody()
        {
            $this->html .= '</body>';
        }

        public function startRow()
        {
            $this->html .= '<tr>';
        }

        public function endRow()
        {
            $this->html .= '</tr>';
        }

        public function addCell($content = '')
        {
            $this->html .= '<td>' . $content . '</td>';
        }
    }
}
