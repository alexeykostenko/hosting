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

    /**
     * Uploaded files ($_POST['_method'] or $_SERVER['REQUEST_METHOD']).
     */
    public $method;

    public $instance;
    public function __construct()
    {
        if ($this->instance === null) {
            $this::initialize();
        }

        return $this->instance;
    }

    public function initialize()
    {
        $this->request = $_POST;
        $this->query = $_GET;
        $this->files = $_FILES;
        $this->server = $_SERVER;
        $this->method = $this->getMethod();
        $this->instance = $this;
    }

    public function url()
    {
        return $this->server['REDIRECT_URL'];
    }

    public function fullUrl()
    {
        return $this->server['REQUEST_URI'];
    }

    public function getMethod()
    {
       return $this->request['_method'] ?: $_SERVER['REQUEST_METHOD'];
    }

    public function __get($key)
    {
        return $this->request[$key];
    }
}
