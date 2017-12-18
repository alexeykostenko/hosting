<?php

namespace Controller;

use Classes\Image;
use Classes\Task;
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
            $image['image'] = $img->save($image["name"]);

            $id = model('Image')->create($image);

            $task = [];
            $task['number'] = $id;

            (new Task('image'))->add($task);
        }
    }

    public function update()
    {
        request()->validate([
            'id' => 'number|exists:images',
            'title' => 'required|max:100',
            'description' => 'required|max:255',
        ]);

        $data = [];
        $data['title'] = request()->title;
        $data['description'] = request()->description;

        model('Image')->update($data, request()->id);
    }

    public function delete()
    {
        request()->validate([
            'id' => 'number|exists:images',
        ]);

        model('Image')->delete(request()->id);
    }
}
