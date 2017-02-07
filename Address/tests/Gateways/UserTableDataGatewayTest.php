<?php

namespace Address\Gateways
{

    use Address\Loggers\ErrorLogger;
    use Address\ParameterObjects\UserParameterObject;

    class UserTableDataGatewayTest extends \PHPUnit_Framework_TestCase
    {
        /** @var ErrorLogger | \PHPUnit_Framework_MockObject_MockObject */
        private $logger;

        /** @var \PDO */
        private $pdo;

        /** @var UserTableDataGateway */
        private $gateway;

        protected function setUp()
        {
            $this->logger = $this->getMockBuilder(ErrorLogger::class)->disableOriginalConstructor()->getMock();
            $this->pdo = $this->initDatabase();
            $this->gateway = new UserTableDataGateway($this->pdo, $this->logger);
        }

        public function testUserCanBeInserted()
        {
            $row = new UserParameterObject('test', '123456', 'test@bla.ch');
            $this->gateway->insert($row);

            $this->assertTrue($this->gateway->findUserByUsername('test'));
        }

        public function testUserCanBeFoundByCredentials()
        {
            $this->assertTrue($this->gateway->findUserByCredentials('foobar', '123456'));
        }

        public function testGatewayReturnsFalseIfUserNotFoundWithCredentials()
        {
            $this->assertFalse($this->gateway->findUserByCredentials('invalidUser', '111111'));
        }

        public function testGatewayReturnsFalseIfUserNotFoundWithUsername()
        {
            $this->assertFalse($this->gateway->findUserByUsername('invalidUser'));
        }

        private function initDatabase()
        {
            $pdo = new \PDO('sqlite::memory:');
            $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

            $pdo->query(
                'CREATE TABLE users (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                username VARCHAR(50) NOT NULL,
                password VARCHAR(255) NOT NULL,
                email VARCHAR(80) NOT NULL,
                created TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP)'
            );

            // Insert row
            $username = 'foobar';
            $password = password_hash('123456', PASSWORD_DEFAULT);
            $email = 'foo@bar.com';

            $stmt = $pdo->prepare(
                'INSERT INTO users (username, password, email)
                VALUES (:username, :password, :email)'
            );

            $stmt->bindParam(':username', $username, \PDO::PARAM_STR);
            $stmt->bindParam(':password', $password, \PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, \PDO::PARAM_STR);
            $stmt->execute();

            $query = $pdo->query('SELECT * FROM users');
            $result = $query->fetchAll(\PDO::FETCH_COLUMN);
            if (count($result) != 1) {
                throw new \Exception('Database could not be initialized!');
            }

            return $pdo;
        }
    }
}
