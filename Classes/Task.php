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
        return model($modelName)->performTask();
    }

    public function add($task)
    {
        $task['type'] = $this->type;
        $task['created_at'] = date('Y-m-d h:i:s');

        return model('Task')->create($task);
    }

    public function remove($number)
    {
        return model('Task')->delete($number);
    }

    public function exists($number)
    {
        return (bool) model('Task')
            ->where('number', '=', $number)
            ->count();
    }
}
