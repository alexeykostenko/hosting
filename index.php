<?php

require __DIR__ . "/autoload.php";

ini_set('display_errors', config('display_errors'));

$app = require_once __DIR__ . '/app.php';
$app->start();
