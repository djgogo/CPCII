<?php

namespace Suxx\Gateways {

    use Suxx\Entities\Comment;
    use Suxx\Exceptions\CommentTableGatewayException;
    use Suxx\Loggers\ErrorLogger;

    class CommentTableDataGateway
    {
        /**
         * @var \PDO
         */
        private $pdo;

        /**
         * @var ErrorLogger
         */
        private $logger;

        public function __construct(\PDO $pdo, ErrorLogger $logger)
        {
            $this->pdo = $pdo;
            $this->logger = $logger;
        }

        public function insert(array $row) : string
        {
            try {
                $stmt = $this->pdo->prepare(
                    'INSERT INTO comments (pid, author, comment, picture) 
            VALUES (:pid, 
                    :author, 
                    :comment, 
                    :picture)'
                );

                $stmt->bindParam(':pid', $row['pid'], \PDO::PARAM_INT);
                $stmt->bindParam(':author', $row['author'], \PDO::PARAM_STR);
                $stmt->bindParam(':comment', $row['comment'], \PDO::PARAM_STR);
                $stmt->bindParam(':picture', $row['picture'], \PDO::PARAM_STR);

                $stmt->execute();
                return $this->pdo->lastInsertId();

            } catch (\PDOException $e) {
                $message = 'Kommentar konnte nicht eingefügt werden.';
                $this->logger->log($message, $e);
                throw new CommentTableGatewayException($message);
            }
        }

        public function findCommentsByPid(int $id) : array
        {
            try {
                $stmt = $this->pdo->prepare("SELECT * FROM comments WHERE pid=:pid");
                $stmt->bindParam(':pid', $id, \PDO::PARAM_INT);
                $stmt->execute();
                return $stmt->fetchAll(\PDO::FETCH_CLASS, Comment::class);
            } catch (\PDOException $e) {
                $message = 'Kommentare konnten nicht ausgelesen werden.';
                $this->logger->log($message, $e);
                throw new CommentTableGatewayException($message);
            }
        }
    }
}
