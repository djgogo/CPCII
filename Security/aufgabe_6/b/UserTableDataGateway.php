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

    public function findIdByCredentials($username, $password)
    {
        try {
            $stmt = $this->pdo->prepare("id FROM user where username==:uname AND passwd=:pass LIMIT 1");
            $stmt->execute(array(':uname' => $username, ':pass' => $password));
            $userRow = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($stmt->rowCount() > 0) {
                if (password_verify($password, $userRow['username'])) {
                    return $stmt->fetchColumn(0);
                } else {
                    return false;
                }
            }
        } catch (PDOException $e) {
            printf("%s, Benutzer: %s ist nicht in der Datenbank", $e->getMessage(), $username);
        }
    }

    public function findUserByUserName($username)
    {
        $sql = sprintf(
            "SELECT id, username, realname, email FROM user where username=%s",
            $this->pdo->quote($username, PDO::PARAM_STR)
        );
        $result = $this->pdo->query($sql);
        if ($result->columnCount() != 1) {
            return false;
        }
        return $result->fetch(PDO::FETCH_ASSOC);
    }

    public function updatePassword($id, $password)
    {
        $sql = sprintf(
            "UPDATE user SET passswd=%s WHERE id=%d",
            $this->pdo->quote($password, PDO::PARAM_STR),
            $this->pdo->quote($id, PDO::PARAM_INT)
        );
        $rc = $this->pdo->exec($sql);
        if ($rc != 1) {
            throw new RuntimeException("No record was updated");
        }
    }

}
