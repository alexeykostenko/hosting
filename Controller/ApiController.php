<?php

namespace Controller;

use Classes\Image;
use Model\Image as ImageModal;

class ApiController
{
    public function create()
    {
        $limit = config('limit_upload_images');
        $images = array_slice(request()->images, 0, $limit);

        foreach ($images as $imageName) {
            $image = Image::make($imageName);
            $imageName = $image->save();
            ImageModal::create(['name' => $imageName]);
        }
    }

    public function update()
    {

    }

    public function delete()
    {

    }
}
