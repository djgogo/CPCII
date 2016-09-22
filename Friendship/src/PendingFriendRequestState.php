<?php

class PendingFriendRequestState extends AbstractFriendRequestState
{
    public function accept() : AcceptedFriendRequestState
    {
        return new AcceptedFriendRequestState;
    }

    public function decline() : DeclinedFriendRequestState
    {
        return new DeclinedFriendRequestState;
    }
}
