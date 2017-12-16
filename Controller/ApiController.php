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
            $imageSaved = Image::make($image["tmp_name"])->save($image["name"]);

            if ($imageSaved) {
                ImageModal::create($image);
            }
        }
    }

    public function update()
    {

    }

    public function delete()
    {

    }
}
