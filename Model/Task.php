<?php

namespace Model;

class Task extends Model
{
    protected $table = 'tasks';
    protected $fillable = [
        'number',
        'type',
        'created_at'
    ];
}
