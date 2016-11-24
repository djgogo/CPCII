<?php

namespace Suxx\Factories {

    use Suxx\Exceptions\InvalidPdoAttributeException;
    use Suxx\Loggers\ErrorLogger;

    class PDOFactory
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
         * @var \PDO
         */
        private $instance = null;

        public function __construct(string $host, string $dbName, string $user, string $pass)
        {
            $this->host = $host;
            $this->dbName = $dbName;
            $this->user = $user;
            $this->pass = $pass;
        }

        public function getDbHandler() : \PDO
        {
            if ($this->instance === null) {
                $this->instance = $this->getPdo($this->host, $this->dbName, $this->user, $this->pass);
            }
            return $this->instance;
        }

        private function getPdo($host, $dbName, $user, $pass) : \PDO
        {
            try {
                $db = new \PDO(
                    "mysql:host=$host;dbname=$dbName",
                    $user,
                    $pass
                );
                $db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
                return $db;
            } catch (\PDOException $e) {
                throw new InvalidPdoAttributeException('Wrong mySql Credentials - Access denied!', 0, $e);
            }
        }
    }
}
