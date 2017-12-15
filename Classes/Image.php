<?php

namespace Hosting\Classes;

class Image
{
    public static $image;
    private static $_instance = null;

    public function make($image)
    {
        if (self::$_instance === null) {
            self::$_instance = new self;
        }

        self::$image = $image;
        return self::$_instance;
    }

    public function save()
    {
        return 'save';
    }

    public function saveThumb()
    {
        return 'saveThumb';
    }
}
