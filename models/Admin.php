<?php

namespace models;

use core\Model;

class Admin extends Model
{

    public function login()
    {
        $_SESSION['admin'] = 'admin';
        return true;
    }

    public function logout()
    {
        unset($_SESSION['admin']);
    }

    public function checkData($log, $pas)
    {
        if ($log == 'admin' and $pas == '123') {
            return true;
        } else {
            $this->error = 'Логин или пароль указан не верно';
            return false;
        }
    }
}
