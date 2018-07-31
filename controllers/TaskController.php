<?php
namespace controllers;

use core\Controller;
use core\Pagination;

class TaskController extends Controller
{
    public function indexAction()
    {
        $pagination = new Pagination($this->route, $this->model->taskCount(), 3);

        $vars = [
            'pagination' => $pagination->get(),
            'tasks'      => $this->model->getTasks($this->route),
        ];
        $this->view->render('Задачи', $vars);
    }

    public function readAction()
    {
        $this->view->render('Задача');
    }

    public function addAction()
    {

        if (!empty($_POST)) {
            if (!$this->model->validate(['user', 'email'], $_POST)) {
                $this->view->message('error', $this->model->error);
            } else if (!$this->model->addImage($_FILES['image'])) {
                $this->view->message('error', $this->model->error);
            }
            $_POST['task'] = $this->model->sanitizeText($_POST['task']);
            $this->model->addTask($_POST);
            $this->view->message('success', 'Задача добавлена');
        }

        $this->view->render('Добавить задачу');
    }

    public function editAction()
    {

        if (!empty($_POST)) {
            if (!$this->model->validate(['status'], $_POST)) {
                $this->view->message('error', $this->model->error);
            }
            $_POST['task'] = $this->model->sanitizeText($_POST['task']);
            $this->model->editTask($_POST, $this->route);
            $this->view->message('success', 'Задача изменена');
        }

        $vars = [
            'task' => $this->model->getTask($this->route),
        ];
        $this->view->render('Редактировать задачу', $vars);
    }

    public function sortAction()
    {
        if (!empty($_POST)) {
            switch ($_POST['sort']) {
                case 'default':$cookieSort = 'default';
                    break;
                case 'user':$cookieSort = 'user';
                    break;
                case 'email':$cookieSort = 'email';
                    break;
                case 'status':$cookieSort = 'status';
                    break;
                default:$cookieSort = 'default';
            }
            setcookie("sort", $cookieSort, time() + 3600);
        }
    }

}
