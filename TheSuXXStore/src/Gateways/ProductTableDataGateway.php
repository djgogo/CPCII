<?php

namespace Suxx\Gateways {

    use Suxx\Entities\Product;
    use Suxx\Exceptions\ProductTableGatewayException;
    use Suxx\Loggers\ErrorLogger;

    class ProductTableDataGateway
    {
        /**
         * @var \PDO
         */
        private $pdo;

        /**
         * @var ErrorLogger
         */
        private $logger;

        public function __construct(\PDO $pdo, ErrorLogger $logger)
        {
            $this->pdo = $pdo;
            $this->logger = $logger;
        }

        public function getAllProducts()
        {
            try {
                $stmt = $this->pdo->prepare("SELECT * FROM products");
                $stmt->execute();
                return $stmt->fetchAll(\PDO::FETCH_CLASS, Product::class);
            } catch (\PDOException $e) {
                $message = 'Fehler beim lesen der Produkt Tabelle.';
                $this->logger->log($message, $e);
                throw new ProductTableGatewayException($message);
            }
        }

        public function getAllProductsOrderedByUpdatedAscending()
        {
            try {
                $stmt = $this->pdo->prepare("SELECT * FROM products ORDER BY updated ASC");
                $stmt->execute();
                return $stmt->fetchAll(\PDO::FETCH_CLASS, Product::class);
            } catch (\PDOException $e) {
                $message = 'Fehler beim lesen der Produkt Tabelle.';
                $this->logger->log($message, $e);
                throw new ProductTableGatewayException($message);
            }
        }

        public function getAllProductsOrderedByUpdatedDescending()
        {
            try {
                $stmt = $this->pdo->prepare("SELECT * FROM products ORDER BY updated DESC");
                $stmt->execute();
                return $stmt->fetchAll(\PDO::FETCH_CLASS, Product::class);
            } catch (\PDOException $e) {
                $message = 'Fehler beim lesen der Produkt Tabelle.';
                $this->logger->log($message, $e);
                throw new ProductTableGatewayException($message);
            }
        }

        public function getSearchedProduct(string $searchString)
        {
            try {
                $stmt = $this->pdo->prepare('SELECT * FROM products WHERE label LIKE :search ');
                $search = '%' . $searchString . '%';
                $stmt->bindParam(':search', $search, \PDO::PARAM_STR);
                $stmt->execute();
                return $stmt->fetchAll(\PDO::FETCH_CLASS, Product::class);
            } catch (\PDOException $e) {
                $message = 'Fehler beim lesen der Produkt Tabelle.';
                $this->logger->log($message, $e);
                throw new ProductTableGatewayException($message);
            }
        }

        public function findProductById(int $id)
        {
            try {
                $stmt = $this->pdo->prepare("SELECT * FROM products WHERE pid=:pid LIMIT 1");
                $stmt->bindParam(':pid', $id, \PDO::PARAM_INT);
                $stmt->execute();
                return $stmt->fetchObject(Product::class);
            } catch (\PDOException $e) {
                $message = 'Fehler beim lesen der Produkt Tabelle.';
                $this->logger->log($message, $e);
                throw new ProductTableGatewayException($message);
            }
        }

        public function update(array $row) : bool
        {
            try {
                $stmt = $this->pdo->prepare(
                    'UPDATE products SET label=:label, price=:price WHERE pid=:pid'
                );

                $stmt->bindParam(':pid', $row['pid'], \PDO::PARAM_INT);
                $stmt->bindParam(':label', $row['label'], \PDO::PARAM_STR);
                $stmt->bindParam(':price', $row['price'], \PDO::PARAM_STR);

                $stmt->execute();
                return true;

            } catch (\PDOException $e) {
                $message = 'Fehler beim ändern eines Datensatzes der Produkt Tabelle.';
                $this->logger->log($message, $e);
                throw new ProductTableGatewayException($message);
            }
        }
    }
}
