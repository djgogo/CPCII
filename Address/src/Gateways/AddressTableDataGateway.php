<?php

namespace Address\Gateways {

    use Adddress\Entities\Address;
    use Address\Exceptions\AddressTableGatewayException;
    use Address\Loggers\ErrorLogger;

    class AddressTableDataGateway
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

        public function getAllAddresses(): array
        {
            try {
                $stmt = $this->pdo->prepare("SELECT * FROM addresses");
                $stmt->execute();
                return $stmt->fetchAll(\PDO::FETCH_CLASS, Address::class);
            } catch (\PDOException $e) {
                $message = 'Fehler beim lesen der Address Tabelle.';
                $this->logger->log($message, $e);
                throw new AddressTableGatewayException($message);
            }
        }

        public function getAllAddressesOrderedByUpdatedAscending(): array
        {
            try {
                $stmt = $this->pdo->prepare("SELECT * FROM addresses ORDER BY updated ASC");
                $stmt->execute();
                return $stmt->fetchAll(\PDO::FETCH_CLASS, Address::class);
            } catch (\PDOException $e) {
                $message = 'Fehler beim lesen der Address Tabelle.';
                $this->logger->log($message, $e);
                throw new AddressTableGatewayException($message);
            }
        }

        public function getAllAddressesOrderedByUpdatedDescending(): array
        {
            try {
                $stmt = $this->pdo->prepare("SELECT * FROM addresses ORDER BY updated DESC");
                $stmt->execute();
                return $stmt->fetchAll(\PDO::FETCH_CLASS, Address::class);
            } catch (\PDOException $e) {
                $message = 'Fehler beim lesen der Address Tabelle.';
                $this->logger->log($message, $e);
                throw new AddressTableGatewayException($message);
            }
        }

        public function getSearchedAddress(string $searchString): array
        {
            try {
                $stmt = $this->pdo->prepare('SELECT * FROM addresses WHERE address1 LIKE :search ');
                $search = '%' . $searchString . '%';
                $stmt->bindParam(':search', $search, \PDO::PARAM_STR);
                $stmt->execute();
                return $stmt->fetchAll(\PDO::FETCH_CLASS, Address::class);
            } catch (\PDOException $e) {
                $message = 'Fehler beim lesen der Address Tabelle.';
                $this->logger->log($message, $e);
                throw new AddressTableGatewayException($message);
            }
        }

        public function findAddressById(int $id): Address
        {
            try {
                $stmt = $this->pdo->prepare("SELECT * FROM addresses WHERE id=:id LIMIT 1");
                $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
                $stmt->execute();
                return $stmt->fetchObject(Address::class);
            } catch (\PDOException $e) {
                $message = 'Fehler beim lesen der Address Tabelle.';
                $this->logger->log($message, $e);
                throw new AddressTableGatewayException($message);
            }
        }

        public function update(array $row): bool
        {
            try {
                $stmt = $this->pdo->prepare(
                    'UPDATE addresses SET address1=:address1, address2=:address2, city=:city, postalCode=:postalCode, updated=:updated WHERE id=:id'
                );

                $stmt->bindParam(':id', $row['id'], \PDO::PARAM_INT);
                $stmt->bindParam(':address1', $row['address1'], \PDO::PARAM_STR);
                $stmt->bindParam(':address2', $row['address2'], \PDO::PARAM_STR);
                $stmt->bindParam(':city', $row['city'], \PDO::PARAM_STR);
                $stmt->bindParam(':postalCode', $row['postalCode'], \PDO::PARAM_INT);
                $stmt->bindParam(':updated', $row['updated'], \PDO::PARAM_STR);

                $stmt->execute();
                return true;

            } catch (\PDOException $e) {
                $message = 'Fehler beim ändern eines Datensatzes der Adress Tabelle.';
                $this->logger->log($message, $e);
                throw new AddressTableGatewayException($message);
            }
        }

        public function delete(string $id): bool
        {
            try {
                $stmt = $this->pdo->prepare(
                    'DELETE FROM addresses WHERE id=:id'
                );

                $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
                $stmt->execute();
                return true;

            } catch (\PDOException $e) {
                $message = 'Fehler beim löschen eines Datensatzes der Adress Tabelle.';
                $this->logger->log($message, $e);
                throw new AddressTableGatewayException($message);
            }
        }
    }
}
