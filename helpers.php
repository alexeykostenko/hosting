<?php

function dd()
{
    array_map(function($x) { var_dump($x); }, func_get_args());
    die();
}

function request()
{
    return Classes\Request::getInstance();
}

/**
 * Get the specified configuration value.
 *
 * @param  string $key
 * @param  mixed $default
 * @return mixed
 */
function config($key = null, $default = null)
{
    $configFile = 'config.php';

    $config = new Classes\Config;

    if (is_null($key)) {
        return $config->all();
    }

    return $config->get($key, $default);
}

/**
 * Get the path to the application folder.
 *
 * @param  string  $path
 * @return string
 */
function app_path($path = '')
{
    return __DIR__ . ($path ? DIRECTORY_SEPARATOR . $path : $path);
}
