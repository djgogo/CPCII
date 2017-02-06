<?php

namespace Address\Gateways
{

    use Address\Exceptions\UserTableGatewayException;
    use Address\Loggers\ErrorLogger;
    use Address\ParameterObjects\UserParameterObject;

    class UserTableDataGateway
    {
        /** @var \PDO */
        private $pdo;

        /** @var ErrorLogger */
        private $logger;

        public function __construct(\PDO $pdo, ErrorLogger $logger)
        {
            $this->pdo = $pdo;
            $this->logger = $logger;
        }

        public function insert(UserParameterObject $row)
        {
            $hashedPassword = password_hash($row->getPassword(), PASSWORD_DEFAULT);
            try {
                $stmt = $this->pdo->prepare(
                    'INSERT INTO users (username, password, email) 
                     VALUES (:username, :passwd, :email)'
                );

                $stmt->bindValue(':username', $row->getUsername(), \PDO::PARAM_STR);
                $stmt->bindValue(':passwd', $hashedPassword, \PDO::PARAM_STR);
                $stmt->bindValue(':email', $row->getEmail(), \PDO::PARAM_STR);

                $stmt->execute();

            } catch (\PDOException $e) {
                $message = 'Benutzer konnte nicht eingefügt werden.';
                $this->logger->log($message, $e);
                throw new UserTableGatewayException($message);
            }
        }

        public function findUserByCredentials(string $username, string $password): bool
        {
            try {
                $stmt = $this->pdo->prepare("SELECT password FROM users WHERE username=:username LIMIT 1");
                $stmt->bindParam(':username', $username, \PDO::PARAM_STR);
                $stmt->execute();
                $userRow = $stmt->fetch(\PDO::FETCH_ASSOC);

                if ($userRow !== false) {
                    if (password_verify($password, $userRow['password'])) {
                        //setcookie($username, 'logged in', time() + 60 * 60 * 24 * 31, '/');
                        return true;
                    } else {
                        return false;
                    }
                }

            } catch (\PDOException $e) {
                $message = 'Benutzer konnte nicht gefunden werden.';
                $this->logger->log($message, $e);
                throw new UserTableGatewayException($message);
            }
        }

        public function findUserByUsername(string $username): bool
        {
            try {
                $stmt = $this->pdo->prepare("SELECT * FROM users WHERE username=:username LIMIT 1");
                $stmt->bindParam(':username', $username, \PDO::PARAM_STR);
                $stmt->execute();
                $userRow = $stmt->fetch(\PDO::FETCH_ASSOC);

                if ($userRow !== false && $username === $userRow['username']) {
                    return true;
                }
                return false;

            } catch (\PDOException $e) {
                $message = 'Benutzer konnte nicht gefunden werden.';
                $this->logger->log($message, $e);
                throw new UserTableGatewayException($message);
            }
        }
    }
}
