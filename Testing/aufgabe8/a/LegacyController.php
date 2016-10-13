<?php

class LegacyController
{
    /**
     * @var PDO
     */
    private $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function performAction(int $userId)
    {
        $statement = $this->db->prepare('SELECT * FROM users WHERE id=:user;');
        $statement->bindValue(':user', $userId, PDO::PARAM_INT);
        $statement->execute();

        $record = $statement->fetch(PDO::FETCH_ASSOC);

        // ...

        print 'something';
    }
}

