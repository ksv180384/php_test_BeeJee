<?php

use App\Models\Task;

class IndexController extends Controller {

    private $offset = 3;
    private $sort = ['user_name' => 'user_name', 'user_email' => 'user_email', 'status' => 'ready'];

    public function __construct(){
        parent::__construct();
        $this->model = new Task();
    }

    public function index(){

        if(!empty($_SESSION['message'])){
            $this->message = $_SESSION['message'];
        }
        if(!empty($_SESSION['error'])){
            $this->error = $_SESSION['error'];
        }
        $this->sessionInfoPostRequestNull();

        $page = !empty($_GET['page']) ? ((int)$_GET['page']) - 1 : 0;
        $sort = $this->getSort();

        $count = $this->model->countAll();
        $paginate = [
            'page' => !empty($_GET['page']) ? $_GET['page'] : 1,
            'pages' => ceil($count / $this->offset),
        ];

        $tasks = $this->model->getList($page, $this->offset, $sort);

        $this->view('index', [
            'user' => $this->user,
            'title' => 'Cписок задач',
            'tasks' => $tasks,
            'paginate' => $paginate,
            'message' => $this->message,
            'error' => $this->error,
        ]);
    }

    /**
     * @return array
     */
    private function getSort(){
        $sort = [];
        $sort_field = !empty($_GET['sort']) && !empty($this->sort[$_GET['sort']]) ? $this->sort[$_GET['sort']] : '';
        $sort_type = !empty($_GET['sort_type']) && $_GET['sort_type'] == 'up' ? 'DESC' : 'ASC';
        if(!empty($sort_field)){
            $sort = [$sort_field => $sort_type];
        }

        return $sort;
    }
}