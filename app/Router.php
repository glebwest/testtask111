<?php

class Router
{
    public $method;
    function postRout($request)
    {
        $result = array();
        $result['status'] = 0;
        switch ($request['method'])
        {
            case 'login':
                if (!$_SESSION['admin'])
                {
                    $User = new User();
                    $result = $User->login($request['data']);
                }
                else
                {
                    $result['error'] = 'Вы уже вошли в аккаунт';
                }
                break;
            case 'isdo':
                if ($_SESSION['admin']) {
                    $Task = new Task();
                    $result = $Task->taskIsDo($request['data']);    
                }
                else
                {
                    $result['error'] = 'Нет прав доступа';
                }
                break;
            case 'rewrite':
                if ($_SESSION['admin']) {
                    $Task = new Task();
                    $result = $Task->rewriteTask($request['data']);    
                }
                else
                {
                    $result['error'] = 'Нет прав доступа';
                }
                break;  
            case 'newTask':
                $Task = new Task();
                $result = $Task->newTask($request['data']);
                break;
            default:
                $result['error'] = 'Отсутствует метод';
                break;
        }
        return $result;
    }
    public function __construct()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $postControll = new PostController;
            $postControll->answerJson($this->postRout($postControll->request));
        }
        else
        {
            $pageControll = new PageController;
        }
    }
}