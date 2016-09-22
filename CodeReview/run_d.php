<?php
declare(strict_types = 1);

use CodeReview\d\DatabaseAbstraction;

require_once __DIR__ . '/bootstrap.php';

$db = new DatabaseAbstraction('sqlite::memory:');
$db->connect();
$db->execute('CREATE TABLE test(i INTEGER)');

var_dump($db->query('SELECT * FROM test'));
