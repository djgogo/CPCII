<?php

class RemovedFriendRequestState extends AbstractFriendRequestState
{
    public function request() : PendingFriendRequestState
    {
        return new PendingFriendRequestState;
    }
}
