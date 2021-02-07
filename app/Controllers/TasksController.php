<?php

use App\Models\Task;
use App\Models\User;

class TasksController extends Controller {

    public function __construct(){
        parent::__construct();
        $this->model = new Task();
    }

    public function edit($id){

        if(!isAdm($this->user)){
            $_SESSION['error'] = 'У вас недостаточно прав.';
            header('Location: /login');exit();
        }

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $this->update();
        }

        $task = $this->model->find((int)$id);

        $data = [
            'title' => 'Задача',
            'task' => $task,
            'old' => !empty($_SESSION['old']) ? $_SESSION['old'] : null,
            'error' => !empty($_SESSION['error']) ? $_SESSION['error'] : null
        ];
        $this->sessionInfoPostRequestNull();

        $this->view('tasks/edit', $data);
    }

    public function create(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $this->store();
        }
        $data = [
            'title' => 'Добавить задачу',
            'old' => !empty($_SESSION['old']) ? $_SESSION['old'] : null,
            'error' => !empty($_SESSION['error']) ? $_SESSION['error'] : null
        ];
        $this->sessionInfoPostRequestNull();

        $this->view('tasks/create', $data);
    }

    private function update(){
        if(!isAdm($this->user)){
            header('Location: /login');exit();
        }
        $id = (int)$_POST['id'];
        $content = $_POST['content'];
        $ready = !empty($_POST['ready']) ? 1 : 0;

        $task = $this->model->find($id);
        $updated = $task['updated_at'];
        if(empty($task)){
            $_SESSION['error'] = 'Неверная задача.';
            header('Location: '. $_SERVER["REQUEST_URI"]);exit();
        }
        if($task['content'] != $content){
            $updated = date('Y-m-d H:i:s');
        }

        $_SESSION['old'] = $_POST;
        if(empty($id)){
            header('Location: '. $_SERVER["REQUEST_URI"]);exit();
        }
        if(empty($content)){
            $_SESSION['error'] = 'Описание задачи не должно быть пустым.';
            header('Location: /tasks/edit/' . $id);exit();
        }

        $this->model->update($id, $content, $ready, $updated);

        $this->sessionInfoPostRequestNull();
        $_SESSION['message'] = 'Задача успешно изменена.';
        header('Location: /');exit();

    }

    private function store(){
        $userName = $_POST['user_name'];
        $userEmail = $_POST['user_email'];
        $content = $_POST['content'];

        $_SESSION['old'] = $_POST;
        if(empty($userName)){
            $_SESSION['error'] = 'Не задано имя пользователя.';
            header('Location: /tasks/create');exit();
        }
        if(!filter_var($userEmail, FILTER_VALIDATE_EMAIL)){
            $_SESSION['error'] = 'Не задан email пользователя.';
            header('Location: /tasks/create');exit();
        }
        if(empty($userEmail)){
            $_SESSION['error'] = 'Не задан email пользователя.';
            header('Location: /tasks/create');exit();
        }
        if(empty($content)){
            $_SESSION['error'] = 'Описание задачи не должно быть пустым.';
            header('Location: /tasks/create');exit();
        }

        $this->model->create($content, $userName, $userEmail);

        $this->sessionInfoPostRequestNull();
        $_SESSION['message'] = 'Задача успешно добавлена.';
        header('Location: /');exit();
    }
}