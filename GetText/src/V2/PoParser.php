<?php
declare(strict_types = 1);

namespace GetText\V2
{
    use GetText\Exceptions\GetTextFileException;

    /**
     * POParser parses only following States: msgid, msgstr
     * and creates a new array with the Values, msgid as $key, msgstr as $value
     */
    class PoParser
    {
        /**
         * @var GetTextEntry[]
         */
        private $entries;

        /**
         * @var string
         */
        private $filePath;

        /**
         * @var string
         */
        private $msgId;

        public function __construct(string $filePath)
        {
            $this->filePath = $filePath;
        }

        public function parse() : array
        {
            $handle = $this->load($this->filePath);

            if ($handle) {
                while (!feof($handle)) {
                    $line = fgets($handle);

                    if ($line != '' && $line[0] === 'm') {
                        $this->processLine(trim($line));
                    }
                }
                fclose($handle);
            }

            return $this->entries;
        }

        private function load($filePath)
        {
            if (empty($filePath)) {
                throw new GetTextFileException('Input file not defined.');
            }

            if (!file_exists($filePath)) {
                throw new GetTextFileException('File does not exist' . $filePath);
            }

            if (substr($filePath, strrpos($filePath, '.')) !== '.po') {
                throw new GetTextFileException('The specified file is not a PO file.');
            }

            $handle = fopen($filePath, 'r');

            if ($handle === false) {
                throw new GetTextFileException('Unable to open file for reading: ' . $filePath);
            }

            return $handle;
        }

        private function processLine($line)
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
                $this->addToEntries(new GetTextEntry($this->replaceUnderlines($this->msgId), $value));
            } else {
                $this->msgId = $value;
            }
        }

        private function addToEntries($entry)
        {
            $this->entries[] = $entry;
        }

        private function deQuote($str) : string
        {
            return substr($str, 1, -1);
        }

        private function replaceUnderlines($str) : string
        {
            return str_replace('_', ' ', $str);
        }

        public function printPoData()
        {
            foreach ($this->entries as $entry) {
                printf("msgId:  %s\n", $entry->getMsgId());
                printf("msgStr: %s\n\n", $entry->getMsgStr());
            }
        }
    }
}
