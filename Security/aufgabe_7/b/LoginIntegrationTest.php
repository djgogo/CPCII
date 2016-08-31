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

        $sql = sprintf(
            'INSERT INTO user VALUES(1, "%s", "%s")',
            'Administrator',
            password_hash('secure', PASSWORD_DEFAULT)
        );

        $result = $pdo->exec($sql);
        var_dump($result);
        if ($result != 1) {
            var_dump('Fehler beim Datenbank Initialisieren');
        }
        return $pdo;
    }
}
