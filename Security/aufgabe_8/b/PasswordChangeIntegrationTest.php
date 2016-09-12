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

    public function testUserCanEditPasswordIfLoggedIn()
    {
        // Login User first
        $data = array(
            'USERNAME' => 'Administrator',
            'PASSWORD' => 'secure',
            'REMEMBERME' => 'false'
        );
        $request = new HttpRequest('/login/check', array(), $data);
        $this->session->init($request);
        $processor = $this->factory->getRouter()->route($request);
        $processor->execute($request);

        $this->assertTrue($this->session->hasKey('userId'));

        // Change Password Process
        $data = array(
            'ID' => 1,
            'PASSWORD' => 'newPassword',
            'REMEMBERME' => 'false'
        );
        $request = new HttpRequest('/password/change/check', array(), $data);
        $processor = $this->factory->getRouter()->route($request);
        $result = $processor->execute($request);

        $this->assertInstanceOf('Url', $result);
        $this->assertEquals('/password/change/success', $result->getUri());
        $this->userCanLoginWithNewValidCredentials();
    }

    private function userCanLoginWithNewValidCredentials()
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

    public function testUserCanNotEditPasswordOnRememberMeStatus()
    {
        // Login User with Remember Me first
        $data = array(
            'USERNAME' => 'Administrator',
            'PASSWORD' => 'secure',
            'REMEMBERME' => 'true'
        );
        $cookie = array(
            'rememberme' => 'true',
            'remembermetoken' => '123456',
            'SID' => '99'
        );
        $request = new HttpRequest('/login/check', $cookie, $data);
        $this->session->init($request);
        $processor = $this->factory->getRouter()->route($request);
        $processor->execute($request);

        $this->assertTrue($this->session->hasKey('userId'));
        $this->assertTrue($request->hasCookie('remembermetoken'));

        // Change Password Process
        $data = array(
            'ID' => 1,
            'PASSWORD' => 'newPassword'
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
        $pdo->query(
            'CREATE TABLE user (
                id INTEGER PRIMARY KEY,
                username,
                passwd,
                remembermetoken
            )'
        );

        $id = 1;
        $username = 'Administrator';
        $hashedPassword = password_hash("secure", PASSWORD_DEFAULT);
        $rememberMeToken = null;

        $stmt = $pdo->prepare("INSERT INTO USER (id, username, passwd, remembermetoken) VALUES (:id, :username, :passwd, :remembermetoken)");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':passwd', $hashedPassword, PDO::PARAM_STR);
        $stmt->bindParam(':remembermetoken', $rememberMeToken);
        $stmt->execute();

        if ($stmt->rowCount() != 1) {
            var_dump('Database could not be initialized!');
        }

        return $pdo;
    }
}
