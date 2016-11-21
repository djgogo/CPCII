<?php
use Suxx\SuxxUserTableDataGateway;

/**
 * @covers SuxxAuthenticator
 * @uses \Suxx\SuxxUserTableDataGateway
 */
class AuthenticatorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Suxx\SuxxUserTableDataGateway
     */
    private $database;

    /**
     * @var Authenticator
     */
    private $authenticator;

    protected function setUp()
    {
        $this->database = $this->getMockBuilder(SuxxUserTableDataGateway::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->authenticator = new SuxxAuthenticator($this->database);
    }

    public function testUserCanBeAuthenticated()
    {
        $username = 'suxx';
        $password = '123456';

        $this->database
            ->expects($this->once())
            ->method('findUserByCredentials')
            ->willReturn(true);

        $this->assertTrue($this->authenticator->authenticate($username, $password));
    }
}
