<?php

require 'autoload.php';

class UserPersistenceIntegrationTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var UserRepository
     */
    private $repository;

    protected function setUp()
    {
        $gateway = $this->initDatabase();
        $mapper = new UserMapper($gateway);
        $this->repository = new UserRepository($gateway, $mapper);
    }

    public function testUserCanBeFoundById()
    {
        $user = $this->repository->getUserById(1);
        $this->assertInstanceOf('User', $user);
        $this->assertEquals(1, $user->getId());
    }

//    public function testUserCanBePersisted()
//    {
//        $user = new User(2, "Reiner'o'Zufall", 'Reiner@Zufall.net');
//        $user->setScreenName('Willi "der Böse" Wichtig');
//        $this->repository->addUser($user);
//        $this->repository->commit();
//        $user2 = $this->repository->getUserById(2);
//        $this->assertEquals($user, $user2);
//    }

    public function testCallingGetUserByIdWithInvalidId()
    {
        $this->expectException(PDOException::class);
        $this->repository->getUserById('Invalid');
    }

//    public function testUserCanBeFoundByScreenName()
//    {
//        /** @var User $user */
//        $user = $this->repository->findUserByKey('screenname', 'Administrator');
//        $this->assertInstanceOf('User', $user);
//        $this->assertEquals('Administrator', $user->getScreenName());
//    }
//
//    public function testUserCanBeFoundByEmail()
//    {
//        /** @var User $user */
//        $user = $this->repository->findUserByKey('email', 'root@localhost');
//        $this->assertInstanceOf('User', $user);
//        $this->assertEquals('root@localhost', $user->getEmail());
//    }

    private function initDatabase()
    {
        $pdo = new \PDO('sqlite::memory:');
        $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        $pdo->query(
            'CREATE TABLE user (
                id INTEGER PRIMARY KEY,
                screenname,
                realname,
                email
            )'
        );
        $pdo->query('INSERT INTO user VALUES(1, "Administrator", "Root User", "root@localhost")');
        return new UserTableDataGateway($pdo);
    }

}
