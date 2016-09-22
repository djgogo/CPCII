<?php
declare(strict_types = 1);

/**
 * @covers \FriendRequest
 * @uses \User
 */
class FriendRequestTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var PHPUnit_Framework_MockObject_MockObject
     */
    private $user1;

    /**
     * @var PHPUnit_Framework_MockObject_MockObject
     */
    private $user2;

    /**
     * @var FriendRequest
     */
    private $friendRequest;

    public function setUp()
    {
        $this->user1 = $this->getMockBuilder(User::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->user2 = $this->getMockBuilder(User::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->friendRequest = new FriendRequest($this->user1, $this->user2);
    }

    public function testUserGetFromCanBeRetrieved()
    {
        $this->assertEquals($this->user1, $this->friendRequest->getFrom());
    }

    public function testUserGetToCanBeRetrieved()
    {
        $this->assertEquals($this->user2, $this->friendRequest->getTo());
    }

    public function testFriendRequestCanBeAccepted()
    {
        $this->friendRequest->setState(new AcceptedFriendRequestState());
        $this->assertTrue($this->friendRequest->isAccepted());
    }

    public function testFriendRequestCanBeDeclined()
    {
        $this->friendRequest->setState(new DeclinedFriendRequestState());
        $this->assertTrue($this->friendRequest->isDeclined());
    }

    public function testFriendCanBeRemoved()
    {
        $this->friendRequest->setState(new RemovedFriendRequestState());
        $this->assertTrue($this->friendRequest->isRemoved());
    }

    public function testFriendRequestCanBeSent()
    {
        $this->friendRequest->setState(new PendingFriendRequestState());
        $this->assertTrue($this->friendRequest->isPending());
    }

    public function testFriendHasNoRequestWorks()
    {
        $this->assertTrue($this->friendRequest->isWithoutRequest());
    }

    public function testFriendHasaRequestWorks()
    {
        $friendRequest = new FriendRequest($this->user1, $this->user2, new AcceptedFriendRequestState());
        $this->assertFalse($friendRequest->isWithoutRequest());
    }

    public function testStateCanBeSet()
    {
        $this->friendRequest->setState(new PendingFriendRequestState());
        $this->assertTrue($this->friendRequest->isPending());
    }

    public function testStateCanBeRetrieved()
    {
        $this->friendRequest->setState(new PendingFriendRequestState());
        $this->assertEquals('pending', $this->friendRequest->getState());
    }

}
