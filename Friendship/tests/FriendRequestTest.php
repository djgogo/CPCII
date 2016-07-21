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
    private $user;
    /**
     * @var FriendRequest
     */
    private $friendRequest;

    public function setUp()
    {
        $this->user = $this->getMockBuilder(User::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->friendRequest = new FriendRequest($this->user, $this->user);
    }

    public function testGetFromCanBeRetrieved()
    {
        $this->assertEquals($this->user, $this->friendRequest->getFrom());
    }

    public function testGetToCanBeRetrieved()
    {
        $this->assertEquals($this->user, $this->friendRequest->getTo());
    }

    public function testStatusCanBeSetAndRetrieved()
    {
        $status = 'motivated';
        $this->friendRequest->setStatus($status);
        $this->assertEquals($status, $this->friendRequest->getStatus());
    }
}
