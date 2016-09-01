<?php

require 'autoload.php';

class LoginIntegrationTest extends PHPUnit_Framework_TestCase
{
    private $session;
    private $factory;

    protected function setUp()
    {
        $this->factory = new Factory($this->initDatabase());
        $this->session = $this->factory->getSession();
    }

    public function testUserCanLoginWithValidCredentials()
    {
        $data = array(
            'USERNAME' => 'Administrator',
            'PASSWORD' => 'secure'
        );
        $request = new HttpRequest('/login/check', array(), $data);
        $this->session->init($request);

        $processor = $this->factory->getRouter()->route($request);
        $result = $processor->execute($request);

        $this->assertTrue($this->session->hasKey('userId'));
        $this->assertInstanceOf('Url', $result);
        $this->assertEquals('/secure', $result->getUri());
    }

    public function testUserCanNotLoginWithInValidCredentials()
    {
        $data = array(
            'USERNAME' => 'Administrator',
            'PASSWORD' => 'Wrong'
        );
        $request = new HttpRequest('/login/check', array(), $data);
        $this->session->init($request);

        $processor = $this->factory->getRouter()->route($request);
        $result = $processor->execute($request);

        $this->assertFalse($this->session->hasKey('userId'));
        $this->assertInstanceOf('Url', $result);
        $this->assertEquals('/login/failed', $result->getUri());
    }

    private function initDatabase()
    {
        $pdo = new \PDO('sqlite::memory:');
        $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        $pdo->query(
            'CREATE TABLE user (
                id INTEGER PRIMARY KEY,
                username,
                passwd
            )'
        );

        $id = 1;
        $username = 'Administrator';
        $hashedPassword = password_hash("secure", PASSWORD_DEFAULT);

        $stmt = $pdo->prepare("INSERT INTO USER (id, username, passwd) VALUES (:id, :username, :passwd)");
        $stmt->execute(array(':id' => $id, ':username' => $username, ':passwd' => $hashedPassword));

        if ($stmt->rowCount() != 1) {
            var_dump('Database could not be initialized!');
        }

//        $stmt = $pdo->prepare("SELECT id, username, passwd FROM user WHERE username=:username AND passwd=:passwd LIMIT 1");
//        $stmt->execute(array(':username' => $username, ':passwd' => $hashedPassword));
//        $userRow = $stmt->fetch(PDO::FETCH_ASSOC);
//
//        var_dump($userRow);

        return $pdo;
    }
}
