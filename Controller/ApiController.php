<?php

namespace Hosting\Controller;

use Hosting\Classes\Image;
use Hosting\Model\Image as ImageModal;

class ApiController
{
    public function create()
    {
        $limit = 5;
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
