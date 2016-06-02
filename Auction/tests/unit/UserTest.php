<?php
declare(strict_types=1);

class UserTest extends PHPUnit_Framework_TestCase
{
    private $nickname;
    private $email;

    /**
     * @var User
     */
    private $user;

    protected function setUp()
    {
        $this->nickname = new Nickname('Tester');
        $this->email    = new Email('admin@example.com');
        $this->user     = new User($this->nickname, $this->email);
    }

    public function testHasNickname()
    {
        $this->assertEquals($this->nickname, $this->user->getNickname());
    }

    public function testHasEmail()
    {
        $this->assertEquals($this->email, $this->user->getEmail());
    }
}
