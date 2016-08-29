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

            if ($stmt->execute() === false) {
                throw new \PDOException(sprintf('Benutzer mit Id "%s" konnte nicht geschrieben werden', $id));
            }

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function findById($id) : array
    {
        $stmt = $this->pdo->prepare(
            'SELECT id, realname, screenname, email FROM user WHERE id=:id '
        );

        if ($stmt->execute([':id' => $id]) === false) {
            throw new \PDOException(sprintf('Benutzer mit Id "%s" konnte nicht ausgelesen werden', $id));
        }

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result === false) {
            throw new PDOException(sprintf('Kein Benutzer gefunden mit der Id "%s"', $id));
        }

        return $result;
    }

    public function findByScreenName($value) : array
    {
        $stmt = $this->pdo->prepare(
            'SELECT id, realname, screenname, email FROM user WHERE screenname=:value '
        );

        if ($stmt->execute([':value' => $value]) === false) {
            throw new \PDOException(sprintf('Benutzer mit dem Screen Name "%s" konnte nicht ausgelesen werden', $value));
        }

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result === false) {
            throw new PDOException(sprintf('Kein Benutzer gefunden mit dem Screen Name "%s"', $value));
        }

        return $result;
    }

    public function findByEmail($value) : array
    {
        $stmt = $this->pdo->prepare(
            'SELECT id, realname, screenname, email FROM user WHERE email=:value '
        );

        if ($stmt->execute([':value' => $value]) === false) {
            throw new \PDOException(sprintf('Benutzer mit der Email "%s" konnte nicht ausgelesen werden', $value));
        }

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result === false) {
            throw new PDOException(sprintf('Kein Benutzer gefunden mit der Email "%s"', $value));
        }

        return $result;
    }

    public function escape($value)
    {
        return $this->pdo->quote($value);
    }
}
