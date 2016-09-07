<?php

$name = isset($_GET['name']) ? $_GET['name'] : 'Anonymous User';

// Verify, given Name is valid
if (!ereg("^[a-zA-Z0-9 +-]*$", $name)) {
    echo "Sorry, that name contains invalid chars";
}

echo "Welcome, $name";
