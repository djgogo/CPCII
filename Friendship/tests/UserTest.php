<?php
declare(strict_types = 1);

/**
 * @covers \User
 * @uses   \FriendRequest
 */
class UserTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var User
     */
    private $user1;

    /**
     * @var User
     */
    private $user2;

    /**
     * @var FriendRequest
     */
    private $friendRequest;

    public function setUp()
    {
        $this->user1 = new User('User1');
        $this->user2 = new User('User2');

        $this->friendRequest = new FriendRequest($this->user1, $this->user2);
    }

    public function testFriendCanBeAdded()
    {
        $this->user2->addFriendRequest($this->friendRequest);
        $this->assertEquals('pending', $this->friendRequest->getState());
        $this->assertTrue($this->friendRequest->isPending());
    }

    public function testFriendRequestCannotBeAddedIfAlreadyAdded()
    {
        $this->expectException(InvalidFriendRequestException::class);
        $this->user2->addFriendRequest($this->friendRequest);
        $this->user2->addFriendRequest($this->friendRequest);
    }

    public function testHappyPathRequestCanBeConfirmed()
    {
        $this->user2->addFriendRequest($this->friendRequest);
        $this->user2->confirm($this->friendRequest);
        $this->assertContains($this->user1, $this->user2->getFriends());
        $this->assertContains($this->user2, $this->user1->getFriends());
    }

    public function testFriendRequestCannotBeConfirmedTwice()
    {
        $this->expectException('InvalidFriendRequestException');
        $this->user2->addFriendRequest($this->friendRequest);
        $this->user2->confirm($this->friendRequest);
        $this->user2->confirm($this->friendRequest);
    }

    public function testNotExistingFriendRequestCannotBeDeclined()
    {
        $this->expectException('InvalidFriendRequestException');
        $this->user1->decline($this->friendRequest);
    }

    public function testFriendRequestMustBeAddedBeforeConfirming()
    {
        $this->expectException('InvalidFriendRequestException');
        $this->user2->confirm($this->friendRequest);
    }

    public function testOnlyFriendsCanBeRemoved()
    {
        $this->expectException('InvalidFriendRequestException');
        $this->user1->removeFriendship($this->user2);
    }

    public function testHappyPathCancellationOfFriendship()
    {
        $this->user2->addFriendRequest($this->friendRequest);
        $this->user2->confirm($this->friendRequest);
        $this->user1->removeFriendship($this->user2);
        $this->assertNotContains($this->user1, $this->user2->getFriends());
        $this->assertNotContains($this->user2, $this->user1->getFriends());
    }

    public function testFriendRequestCannotBeDeclinedTwice()
    {
        $this->expectException('InvalidFriendRequestException');
        $this->user2->addFriendRequest($this->friendRequest);
        $this->user2->decline($this->friendRequest);
        $this->user2->decline($this->friendRequest);
    }

    public function testFriendRequestCannotBeAddedIfAlreadyDeclinedBefore()
    {
        $this->expectException('InvalidFriendRequestException');
        $this->user2->addFriendRequest($this->friendRequest);
        $this->user2->decline($this->friendRequest);
        $this->user2->addFriendRequest($this->friendRequest);
    }
}
