<?php

namespace Classes;

class Request
{
    /**
     * Request body parameters ($_POST).
     */
    private $request;

    /**
     * Query string parameters ($_GET).
     */
    private $query;

    /**
     * Server and execution environment parameters ($_SERVER).
     */
    private $server;

    /**
     * Uploaded files ($_FILES).
     */
    private $files;

    /**
     * Uploaded files ($_POST['_method'] or $_SERVER['REQUEST_METHOD']).
     */
    private $method;

    static private $instance = null;

    private function __construct() { /* ... @return Singleton */ }  // Protect from creation via new Singleton
    private function __clone() { /* ... @return Singleton */ }  // Protect from creation via cloning
    private function __wakeup() { /* ... @return Singleton */ }  // Protect from creation via unserialize

    static public function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
            self::$instance->initialize();
        }

        return self::$instance;
    }

    private function initialize()
    {
        $this->request = $_POST ?: $_GET;
        $this->query = $_GET;
        $this->files = $_FILES;
        $this->server = $_SERVER;
        $this->method = $this->getMethod();
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
       return isset($this->request['_method']) ? $this->request['_method'] : $_SERVER['REQUEST_METHOD'];
    }

    public function __get($key)
    {
        return isset($this->request[$key]) ? $this->request[$key] : null;
    }
}
