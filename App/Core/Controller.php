<?php

namespace App\Core;

class Controller{

    protected $data, $completedData;

    public function __construct(){
        $this->data = array();
    }

    public function loadTemplate($nameView, $data = array()){
        $this->data = $data;
        include "App/Views/template.php";
    }
    
    public function loadView($nameView, $data = array()){
        extract($data);
        include "App/Views/{$nameView}.php";
    }
    
}