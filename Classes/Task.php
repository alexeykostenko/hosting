<?php

namespace Classes;

class Task
{
    private $type;

    public function __construct($type)
    {
        $this->type = $type;
    }

    public function perform()
    {
        $modelName = ucfirst($this->type);
        model($modelName)->performTask();
    }

    public function add($task)
    {
        $task['type'] = $this->type;
        $task['created_at'] = date('Y-m-d h:i:s');

        model('Task')->create($task);
    }
}
