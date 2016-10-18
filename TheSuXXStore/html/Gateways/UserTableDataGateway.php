<?php
class SuxxUserTableDataGateway
{
    /**
     * @var PDO
     */
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function insert(array $row)
    {
        $stmt = $this->pdo->prepare(
            "INSERT INTO user (username, passwd, email, name, descr) VALUES (:username, :passwd, :email, :name, :descr)"
        );
        $stmt->bindParam(':username', $row['username'], PDO::PARAM_STR);
        $stmt->bindParam(':passwd', $row['hashedPassword'], PDO::PARAM_STR);
        $stmt->bindParam(':email', $row['email'], PDO::PARAM_STR);
        $stmt->bindParam(':name', $row['name'], PDO::PARAM_STR);
        $stmt->bindParam(':descr', $row['description'], PDO::PARAM_STR);
        $stmt->execute();

        return $stmt;
    }
}
