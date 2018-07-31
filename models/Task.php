<?php

namespace models;

use core\Model;

class Task extends Model
{
    public $imageName;
    public $error;

    public function validate($input, $post)
    {
        $rules = [
            'email'  => [
                'pattern' => '#^([a-z0-9_.-]{1,20}+)@([a-z0-9_.-]+)\.([a-z\.]{2,10})$#',
                'message' => 'Неправильный еmail',
            ],
            'user'   => [
                'pattern' => '#^[a-z0-9]{3,15}$#',
                'message' => 'Неправильный логин (3-15 символов)',
            ],
            'status' => [
                'pattern' => '#^[0-1]{1,1}$#',
                'message' => 'Ошибка статуса',
            ],
        ];

        foreach ($input as $val) {
            if (!isset($post[$val]) or !preg_match($rules[$val]['pattern'], $post[$val])) {
                $this->error = $rules[$val]['message'];
                return false;
            }
        }
        return true;
    }

    public function sanitizeText($txt)
    {
        return htmlspecialchars(strip_tags($txt));
    }

    public function imageError()
    {
        $this->error = 'Не удалось загрузить изображение';
    }

    public function addImage($file = null)
    {

        $width  = 320;
        $height = 240;

        if (!$data_img = getimagesize($file['tmp_name']) or !$filesize = filesize($file['tmp_name'])) {
            self::imageError();
            return false;
        }

        if (($data_img[2] == '1') or ($data_img[2] == '2') or ($data_img[2] == '3')) {

            if (!@move_uploaded_file($file['tmp_name'], 'upload/' . $file['name'])) {
                self::imageError();
                return false;
            }

            $file_path       = 'upload/' . $file['name'];
            $this->imageName = $file['name'];
            $new_image       = imagecreatetruecolor($width, $height);
            $upload_image    = imagecreatefromjpeg($file_path);
            imagecopyresampled($new_image, $upload_image, 0, 0, 0, 0, $width, $height, $data_img[0], $data_img[1]);

            if ($data_img[2] == '1') {
                imagegif($new_image, $file_path);
                return true;
            } else if ($data_img[2] == '2') {
                imagejpeg($new_image, $file_path, 100);
                return true;
            } else if ($data_img[2] == '3') {
                imagepng($new_image, $file_path);
                return true;
            } else {
                self::imageError();
                return false;
            }

        } else {
            self::imageError();
            return false;
        }

    }

    public function addTask($post)
    {

        $params = [
            'id'     => '',
            'user'   => $post['user'],
            'email'  => $post['email'],
            'task'   => $post['task'],
            'image'  => $this->imageName,
            'status' => '0',
        ];
        $this->db->query('
            INSERT INTO tasks VALUES (:id,:user, :email, :task, :image, :status, NOW())
            ', $params);
        return true;
    }

    public function getTasks($route)
    {
        $max        = 3;
        $sortColumn = 'id';

        $params = [
            'max'   => $max,
            'start' => ((($route['page'] ?? 1) - 1) * $max),
        ];
        $query = 'SELECT * FROM tasks ';
        if (isset($_COOKIE['sort'])) {
            switch ($_COOKIE['sort']) {
                case 'default':$sortColumn = 'id';
                    break;
                case 'user':$sortColumn = 'user';
                    break;
                case 'email':$sortColumn = 'email';
                    break;
                case 'status':$sortColumn = 'status';
                    break;
                default:$sortColumn = 'id';
            }
        }
        $query .= 'ORDER BY ' . $sortColumn;
        $query .= ' LIMIT :start,:max';

        $tasks = $this->db->row($query, $params);
        return $tasks;
    }

    public function taskCount()
    {
        return $this->db->column('SELECT count(id) FROM tasks');
    }

    public function getTask($route)
    {
        $task_id = (int) $route['id'];
        $params  = [
            'id' => $task_id,
        ];
        $task = $this->db->row('SELECT * FROM tasks WHERE id = :id', $params);
        return $task[0];
    }

    public function editTask($post, $route)
    {
        $task_id = (int) $route['id'];
        $params  = [
            'id'     => $task_id,
            'task'   => $post['task'],
            'status' => $post['status'],
        ];
        $this->db->query('UPDATE tasks SET task = :task, status = :status WHERE id = :id', $params);
    }

}
