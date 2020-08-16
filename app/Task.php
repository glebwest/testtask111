<?php

class Task
{
    public $data = array();
    public $sortList = array();
    function setSort($sortName) {
        $this->sortList[] = $sortName;
    }
    function getTaskByID($id)
    {
        return ($task = R::findOne('task','id = ?',[$id]));
    }
    public function getTaskCount() {
        return R::count('task');
    }
    public function getTaskList($pagg = 0, $sort = 'id', $order = 'DESC') {
        $step = 3;
        $first = $step;
        $last = $pagg * $step;
        $list;
        $this->setSort('username');
        $this->setSort('email');
        $this->setSort('isdo');
        $this->setSort('id');
        foreach ($this->sortList as $el) {
            if ($el === $sort)
            {
                if ($order == 'DESC' || $order == 'ASC')
                {
                    $list = R::getAll('SELECT * FROM task ORDER BY ' . $el .' ' . $order . ' LIMIT ' . $first . ' OFFSET ' . $last);
                }
            }
        }
        return $list;
    }
    public function newTask($data)
    {
        $result['status'] = 0;
        if (filter_var($data['email'], FILTER_VALIDATE_EMAIL))
        {
            $this->data = $data;
            $task = R::dispense('task');
            $task->username = $data['name'];
            $task->email = $data['email'];
            $task->tasktext = $data['longtext'];
            $task->isdo = 0;
            R::store($task);
            if ($id = R::getInsertID())
            {
                $result['status'] = 1;
            }
            else {
                $result['error'] = 'Ошибка в данных';
            }
        }
        else
        {
            $result['error'] = 'Ошибка в email';
        }
        return($result);
    }
    public function taskIsDo($data) {
        $result = array();
        if ($task = $this->getTaskByID($data['id']))
        {
            $task->isdo = 1;
            R::store($task);
            $result['status'] = 1;    
        }
        else
        {
            $result['error'] = 'Задача с таким ID не существует';
        }
        return $result;
    }
    public function rewriteTask($data)
    {
        $result = array();
        if ($task = $this->getTaskByID($data['pagg']))
        {
            $task->tasktext = $data['longtext'];
            $task->isrewrite = 1;
            R::store($task);
            $result['status'] = 1;
        }
        else
        {
            $result['error'] = 'Такая запись не найдена';
        }
        return $result;
    }
}