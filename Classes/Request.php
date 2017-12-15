<?php

namespace Hosting\Classes;

class Request
{
    /**
     * Request body parameters ($_POST).
     */
    public $request;

    /**
     * Query string parameters ($_GET).
     */
    public $query;

    /**
     * Server and execution environment parameters ($_SERVER).
     */
    public $server;

    /**
     * Uploaded files ($_FILES).
     */
    public $files;

    public function __construct()
    {
        $this->initialize();
    }

    public function initialize()
    {
        $this->request = $_POST;
        $this->query = $_GET;
        $this->files = $_FILES;
        $this->server = $_SERVER;
    }

    public function url()
    {
        return $this->server['REDIRECT_URL'];
    }

    public function fullUrl()
    {
        return $this->server['REQUEST_URI'];
    }

    public function __get($key)
    {
        return $this->request[$key];
    }
}
