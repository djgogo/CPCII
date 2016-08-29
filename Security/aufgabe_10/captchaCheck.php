<?php

session_start();

if ($_SESSION['CAPTCHA'] != $_REQUEST['code']) {
    die('Captcha value wrong');
}

echo 'Thank you for Submitting!';