<?php

class PDOFactory extends AbstractPdo
{
    /**
     * @var string
     */
    private $host;

    /**
     * @var string
     */
    private $dbName;

    /**
     * @var string
     */
    private $user;

    /**
     * @var string
     */
    private $pass;

    /**
     * @var PDO
     */
    private $instance = null;

    public function __construct(string $host, string $dbName, string $user, string $pass)
    {
        $this->host = $host;
        $this->dbName = $dbName;
        $this->user = $user;
        $this->pass = $pass;
    }

    public function getDbHandler() : PDO
    {
        if ($this->instance === null) {
            $this->instance = $this->getPdo($this->host, $this->dbName, $this->user, $this->pass);
        }
        return $this->instance;
    }
}

