<?php

function __autoload($class)
{
    $parts = explode('\\', $class);
    require __DIR__ . '/' . implode('/', $parts) . '.php';
}

require __DIR__ . '/helpers.php';
