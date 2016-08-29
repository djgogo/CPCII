<?php

session_start();
$success = true;

// Protect Session from being hijacked
if (($_SESSION['IP'] != $_SERVER['REMOTE_ADDR'])
    or ($_SESSION['VIA'] != $_SERVER['HTTP_VIA'])
    or ($_SESSION['FORWARD'] != $_SERVER['HTTP_X_FORWARDED_FOR'])
    or ($_SESSION['AGENT'] != $_SERVER['HTTP_USER_AGENT'])) {

    throw new \OutOfBoundsException('Your request was considered invalid.');
}

// ....