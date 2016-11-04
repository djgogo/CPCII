<?php

class SuxxCommentTableDataGateway
{
    /**
     * @var PDO
     */
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
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

            $stmt->bindParam(':pid', $row['pid'], PDO::PARAM_INT);
            $stmt->bindParam(':author', $row['author'], PDO::PARAM_STR);
            $stmt->bindParam(':comment', $row['comment'], PDO::PARAM_STR);
            $stmt->bindParam(':picture', $row['picture'], PDO::PARAM_STR);

            $stmt->execute();
            return $this->pdo->lastInsertId();

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function findCommentsByPid($id)
    {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM comments WHERE pid=:pid");
            $stmt->bindParam(':pid', $id, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            sprintf("%s, Kommentare mit Id %s konnten nicht ausgelesen werden", $e->getMessage(), $id);
        }
    }
}
