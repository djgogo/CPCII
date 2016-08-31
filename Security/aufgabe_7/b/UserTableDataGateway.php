<?php
class UserTableDataGateway
{
    /**
     * @var PDO
     */
    private $pdo;
    private $userRow;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function findIdByCredentials($username, $password)
    {
        var_dump($password);
        try {
            $stmt = $this->pdo->prepare("SELECT id FROM user WHERE username=:uname AND passwd=:pass LIMIT 1");
            $stmt->execute(array(':uname' => $username, ':pass' => $password));
            $this->userRow = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($stmt->rowCount() > 0) {
                if (password_verify($password, $this->userRow['passwd'])) {
                    return $stmt->fetchColumn(0);
                } else {
                    return false;
                }
            }
        } catch (PDOException $e) {
            //var_dump($this->userRow['passwd']); exit;
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
        $stmt = $this->pdo->prepare("UPDATE user SET passswd=:pass WHERE id=:id");
        $result = $stmt->execute(array(':id' => $id, ':pass' => $password));

        if ($result === false) {
            throw new RuntimeException("No record was updated");
        }
    }
}
