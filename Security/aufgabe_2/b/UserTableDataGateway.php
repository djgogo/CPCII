<?php
class UserTableDataGateway
{

    /**
     * @var PDO
     */
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function insert($id, $realName, $screenName, $eMail)
    {
        try {

            $stmt = $this->pdo->prepare(
                'REPLACE INTO user(id, realName, screenName, eMail) 
             VALUES(:id, 
                    :realName, 
                    :screenName, 
                    :eMail)'
            );

            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':realName', $realName);
            $stmt->bindParam(':screenName', $screenName);
            $stmt->bindParam(':eMail', $eMail);

            $stmt->execute();

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function findById($id)
    {
        $sql = sprintf('SELECT id, realname, screenname, email FROM user WHERE id=%s', $id);
        $result = $this->pdo->query($sql);
        return $result->fetch(PDO::FETCH_ASSOC);
    }

    public function findByKey($key, $value)
    {

    }
}
