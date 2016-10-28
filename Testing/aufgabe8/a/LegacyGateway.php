<?php

class LegacyGateway
{
    /**
     * @var PDO
     */
    private $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }
    public function findUserById($userId)
    {
        $statement = $this->db->prepare('SELECT * FROM users WHERE id=:user;');
        $statement->bindValue(':user', $userId, PDO::PARAM_INT);
        $statement->execute();
        $record = $statement->fetch(PDO::FETCH_ASSOC);

        return $record;
    }
}

