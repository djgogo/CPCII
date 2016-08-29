<?php
class UserTableDataGateway {

    /**
     * @var PDO
     */
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function findIdByCredentials($username, $password) {
        $sql = sprintf(
            "SELECT id FROM user where username=%s and passwd=%s",
            $this->pdo->quote($username, PDO::PARAM_STR),
            $this->pdo->quote($password, PDO::PARAM_STR)
        );
        $result = $this->pdo->query($sql);
        if ($result->columnCount() != 1) {
            return false;
        }
        return $result->fetchColumn(0);
    }

    public function findUserByUserName($username) {
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

    public function updatePassword($id, $password) {
        $sql= sprintf(
            "UPDATE user SET passwd=%s WHERE id=%d",
            $this->pdo->quote($password, PDO::PARAM_STR),
            $this->pdo->quote($id, PDO::PARAM_INT)
        );
        $rc = $this->pdo->execy($sql);
        if ($rc != 1) {
            throw new RuntimeException("No record was updated");
        }
    }

}