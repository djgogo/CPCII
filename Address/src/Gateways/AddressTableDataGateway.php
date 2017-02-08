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

                /**
                 * Setting the PDO::ATTR_ERRMODE to PDO::ERRMODE_EXCEPTION applies to both PDO and PDO::PDOStatement
                 * objects. Also, exceptions are thrown by: PDO::beginTransaction(), PDO::prepare(),
                 * PDOStatement::execute(), PDO::commit(), PDOStatement::fetch(),  PDOStatement::fetchAll()
                 * and so on... Some of these are specified in their respective documentations as to return 'false'
                 * in case of an error. That means that the following execute Method will not return false if it fails!
                 * It will throw a PDOException instead which is already caught
                 */
                $stmt->execute();
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
                $stmt->execute();
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
                $stmt->execute();
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
                $stmt->execute();

                $result = $stmt->fetchObject(Address::class);
                if ($result == false) {
                    throw new \PDOException();
                }
                return $result;

            } catch (\PDOException $e) {
                $message = 'Fehler beim lesen der Address Tabelle mit Id: ' . $id;
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

                $stmt->execute();

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
                $stmt->execute();
                return true;

            } catch (\PDOException $e) {
                $message = 'Fehler beim löschen eines Datensatzes der Adress Tabelle mit der Id: ' . $id;
                $this->logger->log($message, $e);
                throw new AddressTableGatewayException($message);
            }
        }
    }
}
