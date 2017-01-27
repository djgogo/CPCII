<?php

namespace Address\Gateways {

    use Address\Entities\Text;
    use Address\Exceptions\TextTableGatewayException;
    use Address\Loggers\ErrorLogger;

    class TextTableDataGateway
    {
        /** @var \PDO */
        private $pdo;

        /** @var ErrorLogger */
        private $logger;

        public function __construct(\PDO $pdo, ErrorLogger $logger)
        {
            $this->pdo = $pdo;
            $this->logger = $logger;
        }

        public function getAllTexts(): array
        {
            try {
                $stmt = $this->pdo->prepare("SELECT * FROM texts");
                $stmt->execute();
                return $stmt->fetchAll(\PDO::FETCH_CLASS, Text::class);
            } catch (\PDOException $e) {
                $message = 'Fehler beim lesen aller Datensätze der Text Tabelle.';
                $this->logger->log($message, $e);
                throw new TextTableGatewayException($message);
            }
        }

        public function getAllTextsOrderedByUpdatedAscending(): array
        {
            try {
                $stmt = $this->pdo->prepare("SELECT * FROM texts ORDER BY updated ASC");
                $stmt->execute();
                return $stmt->fetchAll(\PDO::FETCH_CLASS, Text::class);
            } catch (\PDOException $e) {
                $message = 'Fehler beim lesen aller Datensätze der Text Tabelle aufsteigend sortiert.';
                $this->logger->log($message, $e);
                throw new TextTableGatewayException($message);
            }
        }

        public function getAllTextsOrderedByUpdatedDescending(): array
        {
            try {
                $stmt = $this->pdo->prepare("SELECT * FROM texts ORDER BY updated DESC");
                $stmt->execute();
                return $stmt->fetchAll(\PDO::FETCH_CLASS, Text::class);
            } catch (\PDOException $e) {
                $message = 'Fehler beim lesen aller Datensätze der Text Tabelle absteigend sortiert.';
                $this->logger->log($message, $e);
                throw new TextTableGatewayException($message);
            }
        }

        public function getSearchedText(string $searchString): array
        {
            try {
                $stmt = $this->pdo->prepare('SELECT * FROM texts WHERE text1 LIKE :search OR text2 LIKE :search ');
                $search = '%' . $searchString . '%';
                $stmt->bindParam(':search', $search, \PDO::PARAM_STR);
                $stmt->execute();
                return $stmt->fetchAll(\PDO::FETCH_CLASS, Text::class);
            } catch (\PDOException $e) {
                $message = 'Fehler beim lesen der Text Tabelle mit Search-Parameter.';
                $this->logger->log($message, $e);
                throw new TextTableGatewayException($message);
            }
        }

        public function findTextById(int $id): Text
        {
            try {
                $stmt = $this->pdo->prepare("SELECT * FROM texts WHERE id=:id LIMIT 1");
                $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
                $stmt->execute();
                return $stmt->fetchObject(Text::class);
            } catch (\PDOException $e) {
                $message = 'Fehler beim lesen der Text Tabelle mit Id-Parameter.';
                $this->logger->log($message, $e);
                throw new TextTableGatewayException($message);
            }
        }

        public function update(array $row): bool
        {
            try {
                $stmt = $this->pdo->prepare(
                    'UPDATE texts SET text1=:text1, text2=:text2, updated=:updated WHERE id=:id'
                );

                $stmt->bindParam(':id', $row['id'], \PDO::PARAM_INT);
                $stmt->bindParam(':text1', $row['text1'], \PDO::PARAM_STR);
                $stmt->bindParam(':text2', $row['text2'], \PDO::PARAM_STR);
                $stmt->bindParam(':updated', $row['updated'], \PDO::PARAM_STR);

                $stmt->execute();
                return true;

            } catch (\PDOException $e) {
                $message = 'Fehler beim ändern eines Datensatzes der Text Tabelle.';
                $this->logger->log($message, $e);
                throw new TextTableGatewayException($message);
            }
        }
    }
}
