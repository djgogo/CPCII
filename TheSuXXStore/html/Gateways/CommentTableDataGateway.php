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
