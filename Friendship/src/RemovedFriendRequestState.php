<?php
class RemovedFriendRequestState extends AbstractFriendRequestState
{
    public function delete() : WithoutFriendRequestState
    {
        return new WithoutFriendRequestState;
    }
}
