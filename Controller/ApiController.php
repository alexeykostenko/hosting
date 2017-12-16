<?php

namespace Controller;

use Classes\Image;
use Model\Image as ImageModal;

class ApiController
{
    public function create()
    {
        if (!isset(request()->files['images']) || !is_array(request()->files['images'])) {
            return false;
        }

        $images = normalize_files(request()->files['images']);

        $limit = config('limit_upload_images');

        $images = array_slice($images, 0, $limit);

        foreach ($images as $image) {
            $img = Image::make($image["tmp_name"]);
            $img->save($image["name"]);
            $img->saveThumb($image["name"]);

            ImageModal::create($image);
        }
    }

    public function update()
    {

    }

    public function delete()
    {

    }
}
