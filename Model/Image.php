<?php

namespace Model;

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
}
