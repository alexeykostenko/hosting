<?php

class App
{
    public function start()
    {
        return require_once __DIR__ . '/routes.php';
    }
}

return new App;
