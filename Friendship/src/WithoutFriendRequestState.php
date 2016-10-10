<?php
class WithoutFriendRequestState extends AbstractFriendRequestState
{
    public function request() : PendingFriendRequestState
    {
        return new PendingFriendRequestState;
    }
}
