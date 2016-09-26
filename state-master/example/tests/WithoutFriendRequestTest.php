<?php
class WithoutFriendRequestTest extends PHPUnit_Framework_TestCase
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
        $this->friendrequest = new FriendRequest(new WithoutFriendRequestState);
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
    public function testIsWithout()
    {
        $this->assertTrue($this->friendrequest->isWithout());
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
     * @covers WithoutFriendRequestState::request
     * @uses   FriendRequest::isPending
     */
    public function testCanBeRequested()
    {
        $this->friendrequest->request();
        $this->assertTrue($this->friendrequest->isPending());
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
