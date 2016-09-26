<?php
class PendingFriendRequestTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var FriendRequest
     */
    private $friendrequest;

    /**
     * @covers FriendRequest::__construct
     * @covers FriendRequest::setState
     */
    protected function setUp()
    {
        $this->friendrequest = new FriendRequest(new PendingFriendRequestState);
    }

    /**
     * @covers FriendRequest::isPending
     */
    public function testIsPending()
    {
        $this->assertTrue($this->friendrequest->isPending());
    }

    /**
     * @covers FriendRequest::isAccepted
     */
    public function testIsNotAccepted()
    {
        $this->assertFalse($this->friendrequest->isAccepted());
    }

    /**
     * @covers FriendRequest::isRemoved
     */
    public function testIsNotRemoved()
    {
        $this->assertFalse($this->friendrequest->isRemoved());
    }

    /**
     * @covers FriendRequest::isDeclined
     */
    public function testIsNotDeclined()
    {
        $this->assertFalse($this->friendrequest->isDeclined());
    }

    /**
     * @covers FriendRequest::isWithout
     */
    public function testIsNotWithout()
    {
        $this->assertFalse($this->friendrequest->isWithout());
    }

    /**
     * @covers FriendRequest::accept
     * @covers PendingFriendRequestState::accept
     * @uses   FriendRequest::isAccepted
     */
    public function testCanBeAccepted()
    {
        $this->friendrequest->accept();
        $this->assertTrue($this->friendrequest->isAccepted());
    }

    /**
     * @covers FriendRequest::decline
     * @covers PendingFriendRequestState::decline
     * @uses   FriendRequest::isDeclined
     */
    public function testCanBeDeclined()
    {
        $this->friendrequest->decline();
        $this->assertTrue($this->friendrequest->isDeclined());
    }

    /**
     * @covers FriendRequest::remove
     * @covers AbstractFriendRequestState::remove
     * @expectedException IllegalStateTransitionException
     */
    public function testCannotBeRemoved()
    {
        $this->friendrequest->remove();
    }

    /**
     * @covers FriendRequest::request
     * @covers AbstractFriendRequestState::request
     * @expectedException IllegalStateTransitionException
     */
    public function testCannotBeRequested()
    {
        $this->friendrequest->request();
    }

    /**
     * @covers FriendRequest::delete
     * @covers AbstractFriendRequestState::delete
     * @expectedException IllegalStateTransitionException
     */
    public function testCannotBeDeleted()
    {
        $this->friendrequest->delete();
    }
}
