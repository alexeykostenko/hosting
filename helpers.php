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

/**
 * Get the relative path to the image storage.
 *
 * @param  string  $path
 * @return string
 */
function image_relative_path($path = '')
{
    return config('images_folder') . ($path ? DIRECTORY_SEPARATOR . $path : $path);
}

function normalize_files($files)
{
    $normalize_files = [];
    $files_count = count($files['name']);
    $files_keys = array_keys($files);

    for ($i = 0; $i < $files_count; $i++) {
        foreach ($files_keys as $key) {
            $normalize_files[$i][$key] = $files[$key][$i];
        }
    }

    return $normalize_files;
}

function get_actual_path($path)
{
    $original_name = pathinfo($path,PATHINFO_FILENAME);
    $extension = pathinfo($path, PATHINFO_EXTENSION);

    $actual_path = $path;
    $i = 1;

    while(file_exists($actual_path))
    {
        $actual_name = (string) $original_name . '(' . $i . ')';
        $actual_path = str_replace($original_name . "." . $extension, $actual_name . "." . $extension, $path);
        $i++;
    }

    return $actual_path;
}

function model($model)
{
    $namespaceModel = '\\Model\\' . $model;
    return new $namespaceModel();
}
