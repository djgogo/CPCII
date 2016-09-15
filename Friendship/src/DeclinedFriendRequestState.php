<?php

class DeclinedFriendRequestState extends AbstractFriendRequestState
{
    public function request() : PendingFriendRequestState
    {
        return new PendingFriendRequestState;
    }
}
