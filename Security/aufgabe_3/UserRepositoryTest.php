<?php
require __DIR__ . '/User.php';
require __DIR__ . '/UserRepository.php';

class UserRepositoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var UserRepository
     */
    private $repository;

    protected function setUp()
    {
        $dom = new \DOMDocument();
        $dom->load(__DIR__ . '/data.xml');
        $this->repository = new UserRepository($dom);
    }

    public function testSearchingForAdministratorReturnsCorrectUser()
    {
        /** @var User $user  */
        $user = $this->repository->getUserByScreenName('Administrator');
        $this->assertInstanceOf('User', $user);
        $this->assertEquals('Administrator', $user->getScreenName());
    }

    public function testSearchingByScreenNameReturnsCorrectUser()
    {
        /** @var User $user  */
        $user = $this->repository->getUserByScreenName('5.25" Floopy');
        $this->assertInstanceOf('User', $user);
        $this->assertEquals('5.25" Floopy', $user->getScreenName());
    }
}
