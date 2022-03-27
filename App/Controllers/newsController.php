<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Model\News;
use App\Model\Login;

class newsController extends Controller{

    public function index(){

        //1 - chamar um model
        $data['news'] = new News();
        //2 - chamar uma view
        //3 - unir back com front

        $this->loadTemplate('news', $data);
        

    }

    public function categoria($nomeCategoria){

        $data['news'] = new News();
        $data['nomeCategoria'] = $nomeCategoria[0];
        if(!empty($data['nomeCategoria']))
            $this->loadTemplate('orderCategory', $data);
        else
            header('Location: '.PATH.'error');
    }

    public function edit($params){
        
        $data['login'] = new Login();
        $data['news'] = new News();
        $data['params'] = $params;
        if(!empty($data['params']))
            $this->loadTemplate('editNews', $data);
        else
            header('Location: '.PATH.'error');
    }

    public function busca($titleNotice){

        $data['news'] = new News();
        $data['title'] = $titleNotice[0];

        $this->loadTemplate('searchNews', $data);
    }

    public function simple($params){

        $data['news'] = new News();
        $data['params'] = $params;

        $this->loadTemplate('simplenews', $data);
    }

}