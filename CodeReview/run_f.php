<?php
declare(strict_types = 1);

use CodeReview\f\PremiumUser;
use CodeReview\f\SpecialContract;

require_once __DIR__ . '/bootstrap.php';

$user = new PremiumUser('Stefan');
$user->addSpecialContract(new SpecialContract());

var_dump($user);
