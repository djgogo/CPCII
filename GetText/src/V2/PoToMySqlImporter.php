<?php
declare(strict_types = 1);

namespace GetText\V2
{
    class PoToMySqlImporter
    {
        /**
         * @var PDOFactory
         */
        private $pdo;

        /**
         * @var int
         */
        private $processedRecords;

        public function __construct(PDOFactory $factory)
        {
            $this->pdo = $factory->getDbHandler();
        }

        public function import(array $getTextEntry)
        {
            /**
             * @var $entry GetTextEntry
             */
            foreach ($getTextEntry as $entry) {

                $msgGerman = $entry->getMsgId();
                $msgFrench = $entry->getMsgStr();
                $importDate = date("Y-m-d H:i:s");

                try {
                    $stmt = $this->pdo->prepare(
                        'INSERT INTO i18n (msgGerman, msgFrench, importDate) 
            VALUES (:msgGerman, 
                    :msgFrench, 
                    :importDate)'
                    );

                    $stmt->bindParam(':msgGerman', $msgGerman, \PDO::PARAM_STR);
                    $stmt->bindParam(':msgFrench', $msgFrench, \PDO::PARAM_STR);
                    $stmt->bindParam(':importDate', $importDate, \PDO::PARAM_STR);

                    $stmt->execute();
                    $this->processedRecords++;

                } catch (\PDOException $e) {
                    throw new \Exception('Translations konnten nicht importiert werden.', 0, $e);
                }
            }
        }

        public function getProcessedEntries() :int
        {
            return $this->processedRecords;
        }
    }
}
