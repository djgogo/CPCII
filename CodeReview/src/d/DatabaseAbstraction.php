<?php
declare(strict_types = 1);

namespace CodeReview\d
{
    use PDO;

    class DatabaseAbstraction
    {
        /**
         * @var string
         */
        private $dsn;

        /**
         * @var PDO
         */
        private $db;

        public function __construct(string $dsn)
        {
            $this->dsn = $dsn;
        }

        public function connect()
        {
            $this->db = new PDO($this->dsn);
        }

        public function execute(string $sql) : int
        {
            return $this->db->exec($sql);
        }

        public function query($sql) : \PDOStatement
        {
            return $this->db->query($sql);
        }
    }
}
