<?php

class DeclinedFriendRequestState extends AbstractFriendRequestState
{
    public function delete() : WithoutFriendRequestState
    {
        return new WithoutFriendRequestState;
    }
}
