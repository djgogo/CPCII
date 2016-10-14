<?php
declare(strict_types = 1);

class ShoppingCartGateway implements ShoppingCartInterface
{
    /**
     * @var PDO
     */
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function findById(UUID $id) : ShoppingCart
    {
        $stmt = $this->pdo->prepare(
            'SELECT id, cart FROM shoppingCart WHERE id=:id '
        );
        $stmt->bindParam(':id', $id);
        if ($stmt->execute() === false) {
            throw new \PDOException(sprintf('Cart mit Id "%s" konnte nicht ausgelesen werden', $id));
        }

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result === false) {
            throw new PDOException(sprintf('Keine ShoppingCart gefunden mit der Id "%s"', $id));
        }

        // Return the Cart Object
        return unserialize($result['cart']);
    }

    public function insert(UUID $id, ShoppingCart $cart)
    {
        try {
            $stmt = $this->pdo->prepare(
                'REPLACE INTO shoppingCart(id, cart) 
             VALUES(:id, 
                    :cart)'
            );

            $serializedCart = serialize($cart);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':cart', $serializedCart);

            if ($stmt->execute() === false) {
                throw new \PDOException(sprintf('Benutzer mit Id "%s" konnte nicht geschrieben werden', $id));
            }

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function update(UUID $id, ShoppingCart $cart)
    {
        try {
            $stmt = $this->pdo->prepare(
                'UPDATE shoppingCart SET cart=:cart WHERE id=:id '
            );

            $serializedCart = serialize($cart);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':cart', $serializedCart);

            if ($stmt->execute() === false) {
                throw new \PDOException(sprintf('Cart mit Id "%s" konnte nicht geändert werden', $id));
            }

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function delete(UUID $id)
    {
        try {
            $stmt = $this->pdo->prepare(
                'DELETE FROM shoppingCart WHERE id=:id'
            );

            $stmt->bindParam(':id', $id);

            if ($stmt->execute() === false) {
                throw new \PDOException(sprintf('Cart mit Id "%s" konnte nicht gelöscht werden', $id));
            }

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}

