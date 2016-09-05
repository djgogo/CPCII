<?php

require 'autoload.php';

class PasswordChangeIntegrationTest extends PHPUnit_Framework_TestCase
{
    private $session;
    private $factory;

    protected function setUp()
    {
        $this->factory = new Factory($this->initDatabase());
        $this->session = $this->factory->getSession();
    }

    public function testUserCanEditPassword()
    {
        $data = array(
            'ID' => 1,
            'PASSWORD' => 'newPassword',
            'REMEMBERME' => 'false'
        );
        $request = new HttpRequest('/password/change/check', array(), $data);
        $this->session->init($request);

        $processor = $this->factory->getRouter()->route($request);
        $result = $processor->execute($request);

        $this->assertInstanceOf('Url', $result);
        $this->assertEquals('/password/change/success', $result->getUri());
        $this->testUserCanLoginWithNewValidCredentials();
    }

    private function testUserCanLoginWithNewValidCredentials()
    {
        $data = array(
            'USERNAME' => 'Administrator',
            'PASSWORD' => 'newPassword',
            'REMEMBERME' => 'false'
        );
        $request = new HttpRequest('/login/check', array(), $data);
        $this->session->init($request);

        $processor = $this->factory->getRouter()->route($request);
        $result = $processor->execute($request);

        $this->assertTrue($this->session->hasKey('userId'));
        $this->assertInstanceOf('Url', $result);
        $this->assertEquals('/secure', $result->getUri());
    }

    public function testUserCanNotEditPasswordWithRememberStatusTrue()
    {
        $data = array(
            'ID' => 1,
            'PASSWORD' => 'newPassword',
            'REMEMBERME' => 'true'
        );

        $cookie = array(
            'rememberme' => 'true',
        );

        $request = new HttpRequest('/password/change/check', $cookie, $data);
        $this->session->init($request);

        $processor = $this->factory->getRouter()->route($request);
        $result = $processor->execute($request);

        $this->assertInstanceOf('Url', $result);
        $this->assertEquals('/login', $result->getUri());
    }

    private function initDatabase()
    {
        $pdo = new \PDO('sqlite::memory:');
        $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);
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
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':passwd', $hashedPassword, PDO::PARAM_STR);
        $stmt->execute();

        if ($stmt->rowCount() != 1) {
            var_dump('Database could not be initialized!');
        }

        return $pdo;
    }
}
