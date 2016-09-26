<?php
class AcceptedFriendRequestTest extends PHPUnit_Framework_TestCase
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
        $this->friendrequest = new FriendRequest(new AcceptedFriendRequestState);
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
    public function testIsAccepted()
    {
        $this->assertTrue($this->friendrequest->isAccepted());
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
     * @covers AcceptedFriendRequestState::remove
     * @uses   FriendRequest::isRemoved
     */
    public function testCanBeRemoved()
    {
        $this->friendrequest->remove();
        $this->assertTrue($this->friendrequest->isRemoved());
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
