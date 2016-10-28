<?php
declare(strict_types = 1);

class PDOFactory
{
    /**
     * @var PDO
     */
    private $pdo;

    public function __construct()
    {
        $this->pdo = new PDO('sqlite::memory:');
        $this->configurePDO();
    }

    public function getPDO() : PDO
    {
        return $this->pdo;
    }

    private function configurePDO()
    {
        // Exceptions statt Fehler
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Assoziative Fetch-Operationen
        $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        // Unterstützung für Foreign-Keys in SQLite
        $this->pdo->exec('PRAGMA foreign_keys = ON;');
    }
}

