<?php

namespace Hosting\Classes;

use \Hosting\Controller;

class Route
{
    /**
     * The route action string.
     *
     * @var string
     */
    public $action;


    /**
     * Register a new GET route with the router.
     *
     * @param  string  $uri
     * @param  string  $action
     */
    public function get($uri, $action)
    {
        return self::actionCall($uri, $action);
    }

    /**
     * Register a new POST route with the router.
     *
     * @param  string  $uri
     * @param  string  $action
     */
    public function post($uri, $action)
    {
        return self::actionCall($uri, $action);
    }

    /**
     * Register a new PUT route with the router.
     *
     * @param  string  $uri
     * @param  string  $action
     */
    public function put($uri, $action)
    {
        return self::actionCall($uri, $action);
    }

    /**
     * Register a new DELETE route with the router.
     *
     * @param  string  $uri
     * @param  string  $action
     */
    public function delete($uri, $action)
    {
        return self::actionCall($uri, $action);
    }

    /**
     * Call a action from Controller.
     *
     * @param  string  $uri
     * @param  string  $action
     */
    public function actionCall($uri, $action)
    {
        if ($uri !== request()->url()) {
            throw new \Exception("The uri {$uri} doesn't exist");
        }

        $actionParts = explode('@', $action);
        $controller = $actionParts[0];
        $action = $actionParts[1];

        $namespaceController = '\\Hosting\\Controller\\' . $controller;

        if (!class_exists($namespaceController)) {
            throw new \Exception("The class {$namespaceController} does not exist");
        }

        $controller = new $namespaceController;

        if (!method_exists($controller, $action)) {
            throw new \Exception("The method {$action} does't exist");
        }

        return $controller->$action();
    }
}
