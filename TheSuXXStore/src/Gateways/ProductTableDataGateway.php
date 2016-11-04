<?php

class SuxxProductTableDataGateway
{
    /**
     * @var PDO
     */
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getAllProducts()
    {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM products");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            sprintf("%s, Error in products-table", $e->getMessage());
        }
    }

    public function findProductById($id)
    {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM products WHERE pid=:pid LIMIT 1");
            $stmt->bindParam(':pid', $id, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            sprintf("%s, Benutzer mit Id %s konnte nicht ausgelesen werden", $e->getMessage(), $id);
        }
    }

    public function update(array $row) : string
    {
        try {
            $stmt = $this->pdo->prepare(
                'UPDATE products SET label=:label, price=:price WHERE pid=:pid'
            );

            $stmt->bindParam(':pid', $row['pid'], PDO::PARAM_INT);
            $stmt->bindParam(':label', $row['label'], PDO::PARAM_STR);
            $stmt->bindParam(':price', $row['price'], PDO::PARAM_STR);

            $stmt->execute();
            return true;

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return false;
    }
}
