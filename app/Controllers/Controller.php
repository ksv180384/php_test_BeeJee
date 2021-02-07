<?php

use App\Models\User;

class Controller{

    protected $user = null;
    protected $model = null;
    protected $message = '';
    protected $error = '';

    public function __construct(){
        if(!empty($_SESSION['user'])){
            $user = new User();
            $this->user = $user->getByUniqid($_SESSION['user']);
        }
    }

    // Подключаем файлы вида
    public function view($view, $data = []) {
        $auth = $this->user;
        if (file_exists('../app/Views/' . $view . '.php')) {
            require_once '../app/Views/' . $view . '.php';
        } else {
            die('Не найден шаблон');
        }
    }

    protected function sessionInfoPostRequestNull(){
        unset($_SESSION['message']);
        unset($_SESSION['error']);
        unset($_SESSION['old']);
    }
}