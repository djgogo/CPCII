<?php

namespace Address\Gateways {

    use Address\Entities\Address;
    use Address\Exceptions\AddressTableGatewayException;
    use Address\Loggers\ErrorLogger;
    use Address\ParameterObjects\AddressParameterObject;

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
                $stmt = $this->pdo->prepare(
                    'SELECT id, address1, address2, city, postalCode, created, updated 
                     FROM addresses'
                );

                if (!$stmt->execute()) {
                    throw new \PDOException();
                }
                return $stmt->fetchAll(\PDO::FETCH_CLASS, Address::class);

            } catch (\PDOException $e) {
                $message = 'Fehler beim lesen aller Datensätze der Address Tabelle.';
                $this->logger->log($message, $e);
                throw new AddressTableGatewayException($message);
            }
        }

        public function getAllAddressesOrderedByUpdated(string $sort): array
        {
            try {
                $stmt = $this->pdo->prepare(
                    "SELECT id, address1, address2, city, postalCode, created, updated 
                     FROM addresses 
                     ORDER BY updated $sort"
                );

                if (!$stmt->execute()) {
                    throw new \PDOException();
                }
                return $stmt->fetchAll(\PDO::FETCH_CLASS, Address::class);

            } catch (\PDOException $e) {
                $message = 'Fehler beim lesen aller Datensätze der Address Tabelle aufsteigend sortiert.';
                $this->logger->log($message, $e);
                throw new AddressTableGatewayException($message);
            }
        }

        public function getSearchedAddress(string $searchString): array
        {
            try {
                $stmt = $this->pdo->prepare(
                    'SELECT id, address1, address2, city, postalCode, created, updated 
                     FROM addresses 
                     WHERE address1 LIKE :search '
                );

                $search = '%' . $searchString . '%';
                $stmt->bindParam(':search', $search, \PDO::PARAM_STR);

                if (!$stmt->execute()) {
                    throw new \PDOException();
                }
                return $stmt->fetchAll(\PDO::FETCH_CLASS, Address::class);

            } catch (\PDOException $e) {
                $message = 'Fehler beim lesen der Address Tabelle mit Search-Parameter.';
                $this->logger->log($message, $e);
                throw new AddressTableGatewayException($message);
            }
        }

        public function findAddressById(int $id): Address
        {
            try {
                $stmt = $this->pdo->prepare(
                    'SELECT id, address1, address2, city, postalCode, created, updated 
                     FROM addresses 
                     WHERE id=:id 
                     LIMIT 1'
                );
                $stmt->bindParam(':id', $id, \PDO::PARAM_INT);

                if (!$stmt->execute()) {
                    throw new \PDOException();
                }

                $result = $stmt->fetchObject(Address::class);
                if ($result == false) {
                    throw new \PDOException();
                }
                return $result;

            } catch (\PDOException $e) {
                $message = 'Fehler beim lesen der Address Tabelle mit Id-Parameter.';
                $this->logger->log($message, $e);
                throw new AddressTableGatewayException($message);
            }
        }

        public function update(AddressParameterObject $address)
        {
            try {
                $stmt = $this->pdo->prepare(
                    'UPDATE addresses 
                     SET address1=:address1, address2=:address2, city=:city, postalCode=:postalCode, updated=:updated 
                     WHERE id=:id'
                );

                $stmt->bindValue(':id', $address->getId(), \PDO::PARAM_INT);
                $stmt->bindValue(':address1', $address->getAddress1(), \PDO::PARAM_STR);
                $stmt->bindValue(':address2', $address->getAddress2(), \PDO::PARAM_STR);
                $stmt->bindValue(':city', $address->getCity(), \PDO::PARAM_STR);
                $stmt->bindValue(':postalCode', $address->getPostalCode(), \PDO::PARAM_INT);
                $stmt->bindValue(':updated', $address->getUpdated(), \PDO::PARAM_STR);

                if (!$stmt->execute()) {
                    throw new \PDOException();
                }

            } catch (\PDOException $e) {
                $message = 'Fehler beim ändern eines Datensatzes der Adress Tabelle.';
                $this->logger->log($message, $e);
                throw new AddressTableGatewayException($message);
            }
        }

        public function delete(string $id)
        {
            try {
                $stmt = $this->pdo->prepare(
                    'DELETE FROM addresses WHERE id=:id'
                );
                $stmt->bindParam(':id', $id, \PDO::PARAM_INT);

                if (!$stmt->execute()) {
                    throw new \PDOException();
                }
                return true;

            } catch (\PDOException $e) {
                $message = 'Fehler beim löschen eines Datensatzes der Adress Tabelle.';
                $this->logger->log($message, $e);
                throw new AddressTableGatewayException($message);
            }
        }
    }
}
