<?php
namespace controllers;

use core\Controller;

class AdminController extends Controller
{

    public function loginAction()
    {
        if (!empty($_POST)) {
            if (!$this->model->checkData($_POST['login'], $_POST['password'])) {
                $this->view->message('error', $this->model->error);
            }
            if ($this->model->login()) {
                $this->view->message('success', 'Вход выполнен');
            };
        }
        $this->view->render('Вход');
    }

    public function logoutAction()
    {
        $this->model->logout();
        $this->view->redirect('');
    }
}
