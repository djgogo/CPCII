<?php
declare(strict_types = 1);

namespace GetText\V2
{
    class PoProcessor
    {
        public function process($line) : GetTextEntry
        {
            $split = explode(' ', $line, 2);
            $state = $split[0];
            $value = $split[1];

            if ($state != 'msgid' && $state != 'msgstr') {
                return;
            }

            $value = $this->deQuote($value);

            if ($value === '') {
                return;
            }

            if ($state === 'msgstr') {
                return new GetTextEntry($this->msgId, $value);
            }

            $this->msgId = $value;

        }

        private function deQuote($str) : string
        {
            return substr($str, 1, -1);
        }
    }
}
