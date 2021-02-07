<?php

class LogoutController extends Controller {

    public function __construct(){
        parent::__construct();
    }

    public function index(){
        unset($_SESSION['user']);
        header('Location: /',true, 307);exit();
    }
}