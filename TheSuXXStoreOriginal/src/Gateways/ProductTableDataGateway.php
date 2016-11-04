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
}
