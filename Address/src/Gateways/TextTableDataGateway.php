<?php

namespace Address\Gateways {

    use Address\Entities\Text;
    use Address\Entities\TextParameterObject;
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
                $stmt = $this->pdo->prepare(
                    'SELECT id, text1, text2, created, updated 
                     FROM texts'
                );

                if (!$stmt->execute()) {
                    throw new \PDOException();
                }
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
                $stmt = $this->pdo->prepare(
                    'SELECT id, text1, text2, created, updated 
                     FROM texts 
                     ORDER BY updated ASC'
                );

                if (!$stmt->execute()) {
                    throw new \PDOException();
                }

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
                $stmt = $this->pdo->prepare(
                    'SELECT id, text1, text2, created, updated 
                     FROM texts 
                     ORDER BY updated DESC'
                );

                if (!$stmt->execute()) {
                    throw new \PDOException();
                }
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
                $stmt = $this->pdo->prepare(
                    'SELECT id, text1, text2, created, updated 
                     FROM texts 
                     WHERE text1 LIKE :search OR text2 LIKE :search'
                );

                $search = '%' . $searchString . '%';
                $stmt->bindParam(':search', $search, \PDO::PARAM_STR);

                if (!$stmt->execute()) {
                    throw new \PDOException();
                }
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
                $stmt = $this->pdo->prepare(
                    'SELECT id, text1, text2, created, updated 
                     FROM texts WHERE id=:id 
                     LIMIT 1'
                );
                $stmt->bindParam(':id', $id, \PDO::PARAM_INT);

                if (!$stmt->execute()) {
                    throw new \PDOException();
                }

                $result = $stmt->fetchObject(Text::class);
                if ($result == false) {
                    throw new \PDOException();
                }
                return $result;

            } catch (\PDOException $e) {
                $message = 'Fehler beim lesen der Text Tabelle mit Id-Parameter.';
                $this->logger->log($message, $e);
                throw new TextTableGatewayException($message);
            }
        }

        public function update(TextParameterObject $text)
        {
            try {
                $stmt = $this->pdo->prepare(
                    'UPDATE texts 
                     SET text1=:text1, text2=:text2, updated=:updated 
                     WHERE id=:id'
                );

                $stmt->bindValue(':id', $text->getId(), \PDO::PARAM_INT);
                $stmt->bindValue(':text1', $text->getText1(), \PDO::PARAM_STR);
                $stmt->bindValue(':text2', $text->getText2(), \PDO::PARAM_STR);
                $stmt->bindValue(':updated', $text->getUpdated(), \PDO::PARAM_STR);

                if (!$stmt->execute()) {
                    throw new \PDOException();
                }

            } catch (\PDOException $e) {
                $message = 'Fehler beim ändern eines Datensatzes der Text Tabelle.';
                $this->logger->log($message, $e);
                throw new TextTableGatewayException($message);
            }
        }
    }
}
