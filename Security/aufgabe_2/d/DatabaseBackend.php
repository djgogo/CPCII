<?php
declare(strict_types = 1);

class DatabaseBackend
{
    /**
     * @var PDO
     */
    private $pdo;

    /**
     * @var PDOStatement
     */
    private $stmt;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function prepare($statement) : PDOStatement
    {
        try {
            return $this->pdo->prepare($statement);
        } catch(\PDOException $e) {
            throw new DatabaseBackendException(sprintf('PDO failed to prepare the statement "%s".', $statement), 0, $e);
        }
    }

    public function bind($parameter, &$variable, $data_type = \PDO::PARAM_STR, $length = null, $driver_options = null)
    {
        try {
            $this->stmt->bindParam($parameter, $variable, $data_type, $length, $driver_options);
        } catch (DatabaseBackendException $e) {
            throw new DatabaseBackendException('PDO failed to bind the Parameters: "' . $e . '"', $e->getCode());

        }
    }

    public function execute($sql) : int
    {
        try {
            $this->stmt = $this->pdo->query($sql);
            if (!$this->stmt) {
                return 0;
            }
            return $this->stmt->rowCount();
        }
        catch (\PDOException $e) {
            throw new DatabaseBackendException('Query failure: "' . $e . '"', $e->getCode());
        }
    }
}
