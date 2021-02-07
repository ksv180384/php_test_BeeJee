<?php

namespace App\Models;

class User extends Model {

    public function __construct(){
        parent::__construct();
    }

    public function attempt($login, $password){
        $login = trim($login);
        $uniqid = null;

        $user = $this->db->row(
            'SELECT `id`, `login`, `adm` FROM `users` WHERE `login` = :login AND `password` = :password',
            ['login' => $login, 'password' => md5($password)]
        );
        if(!empty($user)){
            $uniqid = uniqid($user['id'] . time());
            $user['uniqid'] = $uniqid;
            $this->db->query(
                'UPDATE `users` SET `uniqid` = :uniqid WHERE `id` = :id',
                ['uniqid' => $uniqid, 'id' => $user['id']]);
        }
        $_SESSION['user'] = $uniqid;

        return $user;
    }

    public function getByUniqid($uniqid){
        $res = $this->db->row(
            'SELECT `id`, `login`, `email`, `adm` FROM `users` WHERE `uniqid` = :uniqid',
            ['uniqid' => $uniqid]
        );

        return $res;
    }

    public function getList(){
        $res = $this->db->rowsAll(
            'SELECT `id`, `login`, `email` FROM `users` WHERE true'
        );

        return $res;
    }
}