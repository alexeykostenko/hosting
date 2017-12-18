<?php

namespace Model;

use Classes\Image as ClassImage;

class Image extends Model
{
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
    }
}
