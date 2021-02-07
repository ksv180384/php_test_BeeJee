<?php

use App\Models\User;

class LoginController extends Controller {

    public function __construct(){
        parent::__construct();
    }

    public function index(){

        if($this->user){
            header('Location: /');exit();
        }

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_SESSION['old'] = $_POST;
            if(empty($_POST['login'])){
                $_SESSION['error'] = 'Поле логин не должно быть пустым.';
                header('Location: /login');exit();
            }
            if(empty($_POST['password'])){
                $_SESSION['error'] = 'Поле лпароль не должно быть пустым.';
                header('Location: /login');exit();
            }

            $this->login($_POST['login'], $_POST['password']);

            if(empty($this->user)){
                $_SESSION['error'] = 'Неверный логин или пароль.';
                header('Location: /login');exit();
            }
            if(!isAdm($this->user)){
                $_SESSION['error'] = 'У вас недостаточно прав для редактирования задач.';
                header('Location: /');exit();
            }
            $this->sessionInfoPostRequestNull();
            header('Location: /');exit();
        }

        $data = [
            'title' => 'Авторизация',
            'old' => !empty($_SESSION['old']) ? $_SESSION['old'] : null,
            'error' => !empty($_SESSION['error']) ? $_SESSION['error'] : null
        ];
        $this->sessionInfoPostRequestNull();

        $this->view('login/index', $data);
    }

    private function login($login, $password){
        $user = new User();
        $this->user = $user->attempt($login, $password);
    }
}