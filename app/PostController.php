<?php

class PostController
{
    public $request = array();
    public function answerJson($object)
    {
        echo (json_encode(array('ans' => $object)));
    }
    public function __construct()
    {
        $_REQUEST['JSON'] = json_decode(
            file_get_contents('php://input'), true
        );
        if (!$_REQUEST['JSON']['data']) 
        {
            $this->answerJson('В запросе нет данных');
        } else 
        {
            $this->request = $_REQUEST['JSON'];
        }
    }
}