<?php
declare(strict_types = 1);

namespace GetText
{
    class MySqlToPoExporter
    {
        /**
         * @var \PDO
         */
        private $pdo;

        /**
         * @var GetTextEntry[]
         */
        private $entries;

        public function __construct(PDOFactory $factory)
        {
            $this->pdo = $factory->getDbHandler();
        }

        public function export()
        {
            try {
                $stmt = $this->pdo->prepare("SELECT * FROM i18n");
                $stmt->execute();

                $this->entries = $stmt->fetchAll(\PDO::FETCH_CLASS, GetTextEntry::class);

            } catch (\PDOException $e) {
                throw new \Exception('Fehler beim lesen der i18n Translations Tabelle.', 0, $e);
            }
        }

        public function writePoGetTextFile(string $filename)
        {
            if (file_exists($filename)) {
                throw new \Exception('File "' . $filename . '" exists already');
            }

            foreach ($this->entries as $entry) {

                /**
                 * Write msgId - German Tag
                 */
                $translationString = sprintf("msgid \"%s\"", $this->replaceBlankWithUnderline($entry->getMsgId())) . PHP_EOL;
                $result = file_put_contents($filename, $translationString, FILE_APPEND);
                if ($result === false) {
                    throw new \Exception('Could not write to file "' . $filename . '"');
                }

                /**
                 * Write MsgStr - French Translation
                 */
                $translationString = sprintf("msgstr \"%s\"\n", $entry->getMsgStr()) . PHP_EOL;
                $result = file_put_contents($filename, $translationString, FILE_APPEND);
                if ($result === false) {
                    throw new \Exception('Could not write to file "' . $filename . '"');
                }
            }
        }

        private function replaceBlankWithUnderline($str) : string
        {
            return str_replace(' ', '_', $str);
        }

        public function getProcessedEntries() : int
        {
            return count($this->entries);
        }
    }
}
