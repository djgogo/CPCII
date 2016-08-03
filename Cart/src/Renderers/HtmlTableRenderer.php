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

        public function addDocType()
        {
            $this->html .= '<!DOCTYPE html>';
        }

        public function startHtml()
        {
            $this->html .= '<html lang="de">';
        }

        public function endHtml()
        {
            $this->html .= '</html>';
        }

        public function startHead()
        {
            $this->html .= '<head>';
        }

        public function endHead()
        {
            $this->html .= '</head>';
        }

        public function addMetaTag()
        {
            $this->html .= '<meta charset="UTF-8">';
        }

        public function addTitle(string $title = '')
        {
            $this->html .= '<title>' . $title . '</title>';
        }

        public function startBody()
        {
            $this->html .= '<body>';
        }

        public function endBody()
        {
            $this->html .= '</body>';
        }

        public function startTable()
        {
            $this->html .= '<table>';
        }

        public function endTable()
        {
            $this->html .= '</table>';
        }

        public function addTableHeader(string $header = '')
        {
            $this->html .= '<th>' . $header . '</th>';
        }

        public function startRow()
        {
            $this->html .= '<tr>';
        }

        public function endRow()
        {
            $this->html .= '</tr>';
        }

        public function addCell(string $content = '')
        {
            $this->html .= '<td>' . $content . '</td>';
        }
    }
}
