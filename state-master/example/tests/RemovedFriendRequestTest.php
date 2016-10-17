<?php
class RemovedFriendRequestTest extends PHPUnit_Framework_TestCase
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
        $this->friendrequest = new FriendRequest(new RemovedFriendRequestState);
    }

    /**
     * @covers FriendRequest::isPending
     */
    public function testIsNotPending()
    {
        $this->assertFalse($this->friendrequest->isPending());
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
    public function testIsRemoved()
    {
        $this->assertTrue($this->friendrequest->isRemoved());
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
     * @covers AbstractFriendRequestState::accept
     * @expectedException IllegalStateTransitionException
     */
    public function testCannotBeAccepted()
    {
        $this->friendrequest->accept();
    }

    /**
     * @covers FriendRequest::decline
     * @covers AbstractFriendRequestState::decline
     * @expectedException IllegalStateTransitionException
     */
    public function testCannotBeDeclined()
    {
        $this->friendrequest->decline();
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
     * @covers RemovedFriendRequestState::delete
     * @uses   FriendRequest::isWithout
     */
    public function testCanBeDeleted()
    {
        $this->friendrequest->delete();
        $this->assertTrue($this->friendrequest->isWithout());
    }
}
