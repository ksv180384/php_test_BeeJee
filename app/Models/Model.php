<?php

namespace App\Models;

use App\Lib\Database;

class Model{
    protected $db;

    public function __construct(){
        $this->db = new Database();
    }
}