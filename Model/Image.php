<?php

namespace Model;

use Classes\Image as ClassImage;
use Classes\Task;
use Library\Model;
use Traits\Workable;

class Image extends Model
{
    use Workable;

    protected $table = 'images';
    protected $fillable = [
        'title',
        'description',
        'image',
        'thumb',
        'type',
        'size'
    ];

    public function performTask()
    {
        $tasks = model('Task')->select('number')
            ->where('type', '=', 'image')->get();

        if (empty($tasks)) {
            return false;
        }

        $taskNumbers = array_column($tasks, 'number');

        $images = model('Image')
            ->whereIn('id', $taskNumbers)->get();

        if (empty($images)) {
            return false;
        }

        foreach ($images as $img) {
            $image = ClassImage::make($img->image);
            $filename = basename($img->image);
            $thumbPath = $image->saveThumb($filename);

            $data = [];
            $data['thumb'] = $thumbPath;
            model('Image')->update($data, $img->id);

            (new Task('image'))->remove($img->id);
        }

    }
}
