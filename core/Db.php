<?php
namespace core;

use PDO;

class Db
{

    protected $db;

    public function __construct()
    {
        $config   = require 'config/db-config.php';
        $this->db = new PDO('mysql:host=' . $config['host'] . ';dbname=' . $config['name'] . '', $config['user'], $config['password']);
    }

    public function createTable()
    {
        $this->db->query('
          CREATE TABLE IF NOT EXISTS `tasks` (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          `user` varchar(50) DEFAULT NULL,
          `email` varchar(50) DEFAULT NULL,
          `task` mediumtext,
          `image` varchar(50) DEFAULT NULL,
          `status` int(1) DEFAULT NULL,
          `created` datetime DEFAULT NULL,
          PRIMARY KEY (id)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8;');
    }

    public function query($sql, $params = [])
    {
        $stmt = $this->db->prepare($sql);
        if (!empty($params)) {
            foreach ($params as $key => $val) {
                if (is_int($val)) {
                    $type = PDO::PARAM_INT;
                } else {
                    $type = PDO::PARAM_STR;
                }
                $stmt->bindValue(':' . $key, $val, $type);
            }
        }
        $stmt->execute();
        return $stmt;
    }

    public function row($sql, $params = [])
    {
        $result = $this->query($sql, $params);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function column($sql, $params = [])
    {
        $result = $this->query($sql, $params);
        return $result->fetchColumn();
    }

}
