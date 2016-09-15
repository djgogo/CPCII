<?php

abstract class AbstractFriendRequestState implements FriendRequestState
{
    public function accept()
    {
        throw new IllegalStateTransitionException;
    }

    public function decline()
    {
        throw new IllegalStateTransitionException;
    }

    public function remove()
    {
        throw new IllegalStateTransitionException;
    }

    public function request()
    {
        throw new IllegalStateTransitionException;
    }
}
