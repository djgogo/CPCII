<?php
class SuxxUserTableDataGateway
{
    /**
     * @var PDO
     */
    private $pdo;

    /**
     * @var SuxxErrorLogger
     */
    private $logger;

    public function __construct(PDO $pdo, SuxxErrorLogger $logger)
    {
        $this->pdo = $pdo;
        $this->logger = $logger;
    }

    public function insert(array $row)
    {
        $hashedPassword = password_hash($row['password'], PASSWORD_DEFAULT);
        try {
            $stmt = $this->pdo->prepare(
                'INSERT INTO user (username, passwd, email, name, descr, picture) 
            VALUES (:username, 
                    :passwd, 
                    :email, 
                    :name, 
                    :descr,
                    :picture)'
            );

            $stmt->bindParam(':username', $row['username'], PDO::PARAM_STR);
            $stmt->bindParam(':passwd', $hashedPassword, PDO::PARAM_STR);
            $stmt->bindParam(':email', $row['email'], PDO::PARAM_STR);
            $stmt->bindParam(':name', $row['name'], PDO::PARAM_STR);
            $stmt->bindParam(':descr', $row['description'], PDO::PARAM_STR);
            $stmt->bindParam(':picture', $row['picture'], PDO::PARAM_STR);

            return $stmt->execute();

        } catch (PDOException $e) {
            throw new SuxxCommentTableGatewayException(
                $this->logger->log('Benutzer konnte nicht eingefügt werden.', $e)
            );
        }
    }

    public function findUserByCredentials(string $username, string $password) : bool
    {
        try {
            $stmt = $this->pdo->prepare("SELECT passwd FROM user WHERE username=:username LIMIT 1");
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt->execute();
            $userRow = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($userRow !== false) {
                if (password_verify($password, $userRow['passwd'])) {
                    //setcookie($username, 'logged in', time() + 60 * 60 * 24 * 31, '/');
                    return true;
                } else {
                    return false;
                }
            }

        } catch (PDOException $e) {
            throw new SuxxCommentTableGatewayException(
                $this->logger->log('Benutzer konnte nicht gefunden werden.', $e)
            );
        }
        return false;
    }

    public function findUserByUsername(string $username) : bool
    {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM user WHERE username=:username LIMIT 1");
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt->execute();
            $userRow = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($userRow !== false) {
                if ($username === $userRow['username']) {
                    return true;
                } else {
                    return false;
                }
            }

        } catch (PDOException $e) {
            throw new SuxxCommentTableGatewayException(
                $this->logger->log('Benutzer konnte nicht gefunden werden.', $e)
            );
        }
        return false;
    }
}
