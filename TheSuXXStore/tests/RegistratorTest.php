<?php

/**
 * @covers SuxxRegistrator
 * @uses SuxxUserTableDataGateway
 */
class SuxxRegistratorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var SuxxUserTableDataGateway
     */
    private $database;

    /**
     * @var SuxxRegistrator
     */
    private $registrator;

    protected function setUp()
    {
        $this->database = $this->getMockBuilder(SuxxUserTableDataGateway::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->registrator = new SuxxRegistrator($this->database);
    }

    public function testUserCanBeRegistered()
    {
        $row = [
            'username' => 'foo',
            'password' => '123456',
            'email' => 'foo@bar.com',
            'name' => 'foo bar',
            'description' => 'Suxx Account'
        ];

        $this->database
            ->expects($this->once())
            ->method('insert')
            ->willReturn(true);

        $this->assertTrue($this->registrator->register($row));
    }

    public function testUsernameCanBeFound()
    {
        $username = 'harrypotter';

        $this->database
            ->expects($this->once())
            ->method('findUserByUsername')
            ->willReturn(true);

        $this->assertTrue($this->registrator->usernameExists($username));
    }
}

