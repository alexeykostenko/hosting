<?php

namespace Classes;

class Image
{
    public $image;
    private static $_instance = null;

    public function make($image)
    {
        if (self::$_instance === null) {
            self::$_instance = new self;
        }

        self::$_instance->image = $image;

        return self::$_instance;
    }

    public function save($filename)
    {
        $imagick = new \Imagick($this->image);
        return $imagick->writeImage(image_relative_path($filename));
    }

    public function saveThumb()
    {
        return 'saveThumb';
    }
}
