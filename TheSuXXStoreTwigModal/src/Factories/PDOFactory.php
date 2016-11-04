<?php

class PDOFactory
{
    /**
     * @var PDO
     */
    private $db;

    public function __construct($host, $dbName, $user, $pass)
    {
        try {
            $this->db = new PDO(
                "mysql:host=$host;dbname=$dbName",
                $user,
                $pass
            );
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getDbHandler() : PDO
    {
        return $this->db;
    }
}

