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
        $actualFilename = get_actual_path(image_relative_path($filename));

        return $imagick->writeImage($actualFilename);
    }

    public function saveThumb()
    {
        return 'saveThumb';
    }
}
