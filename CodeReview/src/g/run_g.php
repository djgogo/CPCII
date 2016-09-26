<?php
use CodeReview\g\File;

spl_autoload_register(
    function ($class) {
        include $class . '.php';
    }
);

spl_autoload_register(
    function ($class) {
        include __DIR__ . '/' . $class . '.php';
    }
);

$file = new File();
