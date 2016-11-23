<?php

namespace Suxx\Gateways {

    use Suxx\Loggers\ErrorLogger;
//Covers
    class SuxxCommentTableDataGatewayTest extends \PHPUnit_Framework_TestCase
    {
        /**
         * @var \PDO
         */
        private $pdo;

        /**
         * @var CommentTableDataGateway
         */
        private $gateway;

        /**
         * @var \PHPUnit_Framework_MockObject_MockObject | ErrorLogger
         */
        private $logger;

        protected function setUp()
        {
            $this->logger = $this->getMockBuilder(ErrorLogger::class)->disableOriginalConstructor()->getMock();
            $this->pdo = $this->initDatabase();
            $this->gateway = new CommentTableDataGateway($this->pdo, $this->logger);
        }

        public function testCommentCanBeInserted()
        {
            $row = [
                'pid' => 99,
                'author' => 'suxx test',
                'comment' => 'testing suxx',
                'picture' => ''
            ];

            $this->assertEquals('3', $this->gateway->insert($row));

            $query = $this->pdo->query('SELECT * FROM comments');
            $result = $query->fetchAll(\PDO::FETCH_COLUMN);

            $this->assertEquals(3, count($result));
        }

        public function testCommentsCanBeFoundByPid()
        {
            $products = $this->gateway->findCommentsByPid(88);
            $this->assertEquals(88, $products[0]->getPid());
        }

        private function initDatabase()
        {
            $pdo = new \PDO('sqlite::memory:');
            $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $pdo->query(
                'CREATE TABLE comments (
                cid INTEGER PRIMARY KEY AUTOINCREMENT,
                pid INTEGER UNSIGNED NOT NULL,
                author VARCHAR(200) NOT NULL,
                comment TEXT NOT NULL,
                picture VARCHAR(200) NOT NULL
            )'
            );

            // Insert First Row
            $pid1 = 44;
            $author1 = 'suxx';
            $comment1 = 'Test Kommentar1';
            $picture1 = '';

            $stmt = $pdo->prepare(
                'INSERT INTO comments (pid, author, comment, picture) 
                VALUES (:pid, :author, :comment, :picture)'
            );

            $stmt->bindParam(':pid', $pid1, \PDO::PARAM_STR);
            $stmt->bindParam(':author', $author1, \PDO::PARAM_INT);
            $stmt->bindParam(':comment', $comment1, \PDO::PARAM_STR);
            $stmt->bindParam(':picture', $picture1, \PDO::PARAM_STR);
            $stmt->execute();

            // Insert Second Row
            $pid2 = 88;
            $author2 = 'suxx';
            $comment2 = 'Test Kommentar2';
            $picture2 = 'smiley.jpg';

            $stmt = $pdo->prepare(
                'INSERT INTO comments (pid, author, comment, picture) 
                VALUES (:pid, :author, :comment, :picture)'
            );

            $stmt->bindParam(':pid', $pid2, \PDO::PARAM_STR);
            $stmt->bindParam(':author', $author2, \PDO::PARAM_INT);
            $stmt->bindParam(':comment', $comment2, \PDO::PARAM_STR);
            $stmt->bindParam(':picture', $picture2, \PDO::PARAM_STR);
            $stmt->execute();

            $query = $pdo->query('SELECT * FROM comments');
            $result = $query->fetchAll(\PDO::FETCH_COLUMN);

            if (count($result) != 2) {
                var_dump('Database could not be initialized!'); //$this->fail() ...
            }

            return $pdo;
        }
    }
}
