<?php

namespace App\Models;

class Task extends Model {

    public function __construct(){
        parent::__construct();
    }

    public function find($id){
        $task = $this->db->row(
            'SELECT `id`, `content`, `user_name`, `user_email`, `ready`, `created_at`, `updated_at`
                    FROM `tasks` 
                    WHERE `id` = :id',
            ['id' => $id]
        );

        return $task;
    }

    public function getList($page = 0, $offset = 3, $sort){
        $orderBy = ' ORDER BY `created_at` DESC';
        if(!empty($sort)){
            $orderBy = ' ORDER BY `' . key($sort) . '` ' . $sort[key($sort)];
        }

        $start = $page * $offset;
        $tasks = $this->db->rowsAll(
            'SELECT `id`, 
                         `content`, 
                         `user_name`, 
                         `user_email`, 
                         `ready`, 
                         `created_at`, 
                         `updated_at`
                    FROM `tasks` 
                     ' . $orderBy . ' LIMIT :start, :offset',
            ['start' => $start, 'offset' => $offset]
        );

        return $tasks;
    }

    public function update($id, $content, $ready = 0, $updated = null){

        $this->db->query(
            'UPDATE `tasks` SET `content` = :content, `ready` = :ready, `updated_at` = :updated WHERE `id` = :id',
            ['content' => $content, 'ready' => $ready, 'id' => $id, 'updated' => $updated]);
    }

    public function create($content, $userName, $userEmail){

        $this->db->query(
            'INSERT INTO `tasks` (`content`, `user_name`, `user_email`) 
                               VALUES (:content, :user_name, :user_email)',
            ['content' => $content, 'user_name' => $userName, 'user_email' => $userEmail]);
    }

    public function countAll(){
        $result = $this->db->row(
            'SELECT COUNT(*) AS `count` FROM `tasks`'
        );

        return $result['count'];
    }
}
