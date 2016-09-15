<?php

class AcceptedFriendRequestState extends AbstractFriendRequestState
{
    public function remove() : RemovedFriendRequestState
    {
        return new RemovedFriendRequestState;
    }
}
