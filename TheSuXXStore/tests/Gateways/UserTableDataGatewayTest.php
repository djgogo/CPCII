<?php

namespace Suxx\Gateways {

    use Suxx\Loggers\ErrorLogger;

    /**
     * @covers  Suxx\Gateways\UserTableDataGateway
     * @uses    Suxx\Loggers\ErrorLogger
     */
    class UserTableDataGatewayTest extends \PHPUnit_Framework_TestCase
    {
        /**
         * @var UserTableDataGateway
         */
        private $gateway;

        /**
         * @var \PDO
         */
        private $pdo;

        /**
         * @var \PHPUnit_Framework_MockObject_MockObject | ErrorLogger
         */
        private $logger;

        protected function setUp()
        {
            $this->logger = $this->getMockBuilder(ErrorLogger::class)->disableOriginalConstructor()->getMock();
            $this->pdo = $this->initDatabase();
            $this->gateway = new UserTableDataGateway($this->pdo, $this->logger);
        }

        public function testUserCanBeInserted()
        {
            $row = [
                'username' => 'harrypotter',
                'password' => '123456',
                'email' => 'harry@potter.com',
                'name' => 'Harry Potter',
                'description' => 'Suxx Account',
                'picture' => ''
            ];

            $this->gateway->insert($row);

            $query = $this->pdo->query('SELECT * FROM user');
            $result = $query->fetchAll(\PDO::FETCH_COLUMN);

            $this->assertEquals(2, count($result));
        }

        public function testUserCanBeFindByCredentials()
        {
            $username = 'suxx';
            $password = '123456';
            $this->assertTrue($this->gateway->findUserByCredentials($username, $password));
        }

        public function testGatewayReturnsFalseIfCredentialsAreWrong()
        {
            $username = 'suxx';
            $password = 'wrong password';
            $this->assertFalse($this->gateway->findUserByCredentials($username, $password));
        }

        public function testUserCanBeFindByUsername()
        {
            $username = 'suxx';
            $this->assertTrue($this->gateway->findUserByUsername($username));
        }

        public function testGatewayReturnsFalseIfUsernameNotFound()
        {
            $username = 'wrong username';
            $this->assertFalse($this->gateway->findUserByUsername($username));
        }

        private function initDatabase() : \PDO
        {
            $pdo = new \PDO('sqlite::memory:');
            $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $pdo->query(
                'CREATE TABLE user (
            uid INTEGER PRIMARY KEY AUTOINCREMENT,
            username VARCHAR(30) UNIQUE,
            passwd VARCHAR(255) NOT NULL,
            email VARCHAR(80) NOT NULL,
            name VARCHAR(80) NOT NULL,
            descr TEXT NOT NULL,
            picture VARCHAR(80) NOT NULL,
            created TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
        )'
            );

            $username = 'suxx';
            $hashedPassword = password_hash('123456', PASSWORD_DEFAULT);
            $email = 'suxx@store.net';
            $name = 'Mister Suxx';
            $descr = 'suxx store test';
            $picture = 'suxxFace.jpg';
            $created = date("Y-m-d H:i:s");

            $stmt = $pdo->prepare(
                'INSERT INTO user (username, passwd, email, name, descr, picture, created) 
            VALUES (:username, 
                    :passwd, 
                    :email, 
                    :name, 
                    :descr,
                    :picture,
                    :created)'
            );

            $stmt->bindParam(':username', $username, \PDO::PARAM_STR);
            $stmt->bindParam(':passwd', $hashedPassword, \PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, \PDO::PARAM_STR);
            $stmt->bindParam(':name', $name, \PDO::PARAM_STR);
            $stmt->bindParam(':descr', $descr, \PDO::PARAM_STR);
            $stmt->bindParam(':picture', $picture, \PDO::PARAM_STR);
            $stmt->bindParam(':created', $created, \PDO::PARAM_STR);

            $stmt->execute();

            if ($stmt->rowCount() != 1) {
                throw new \Exception('Database could not be initialized!');
            }

            return $pdo;
        }
    }
}
