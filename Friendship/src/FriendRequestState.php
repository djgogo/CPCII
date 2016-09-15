<?php

interface FriendRequestState
{
    public function accept();
    public function decline();
    public function remove();
    public function request();
}
