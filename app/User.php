<?php

class User
{
    function getUserByName($name)
    {
        return ($user = R::findOne('user','name = ?',[$name]));
    }
    public function login($data)
    {
        $ans = array();
        if (preg_match('/^[a-zA-Z0-9]+$/',$data['name']) === 1)
        {
            $eml = $data['name'];
            if ($user = $this->getUserByName($data['name']))
            {
                if (password_verify($data['pass'],$user['pass']))
                {
                    $_SESSION['admin'] = $user['name'];
                    $ans['status'] = 1;
                }
                else
                {
                    $ans['error'] = 'Ошибка в пароле';
                }
            }
            else
            {
                $ans['error'] = 'Пользователь с таким именем не найден';
            }
        }
        else
        {
            $ans['error'] = 'Ошибка в имени пользователя';
        }
        return $ans;
    }
    public function logout() {
        unset($_SESSION['admin']);
        return 1;
    }
}