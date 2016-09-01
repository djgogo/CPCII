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

            $stmt = $this->pdo->prepare("SELECT id, username, passwd FROM user WHERE username=:username LIMIT 1");
            $stmt->execute(array(':username' => $username));
            $userRow = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($userRow !== false) {
                if (password_verify($password, $userRow['passwd'])) {
                    return (int) $userRow['id'];
                } else {
                    return false;
                }
            }
        } catch (PDOException $e) {
            printf("%s, User: %s was not found in the Database", $e->getMessage(), $username);
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
