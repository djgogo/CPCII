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
        try {
            $stmt = $this->pdo->prepare(
                'INSERT INTO user (username, passwd, email, name, descr) 
            VALUES (:username, 
                    :passwd, 
                    :email, 
                    :name, 
                    :descr)'
            );

            $stmt->bindParam(':username', $row['username'], PDO::PARAM_STR);
            $stmt->bindParam(':passwd', $row['password'], PDO::PARAM_STR);
            $stmt->bindParam(':email', $row['email'], PDO::PARAM_STR);
            $stmt->bindParam(':name', $row['name'], PDO::PARAM_STR);
            $stmt->bindParam(':descr', $row['description'], PDO::PARAM_STR);

            return $stmt->execute();

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function findUserByCredentials(string $username, string $password)
    {
        try {
            $stmt = $this->pdo->prepare("SELECT username, passwd FROM user WHERE username=:username LIMIT 1");
            $stmt->execute(array(':username' => $username));
            $userRow = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($userRow !== false) {
                //if (password_verify($password, $userRow['passwd'])) {
                if ($password === $userRow['passwd']) {
                    $_SESSION['user'] = $username;
                    setcookie($username, 'logged in', time() + 60 * 60 * 24 * 31, '/');
                    return true;
                } else {
                    return false;
                }
            }
        } catch (PDOException $e) {
            printf("%s, User: %s was not found in the Database", $e->getMessage(), $username);
        }
    }
}
