<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Model\Login;

class loginController extends Controller{

    public function index(){

        $data['login'] = new Login();

        $this->loadTemplate('login', $data);
    }

    public function singup(){

        $data['login'] = new Login();

        $this->loadTemplate('singup', $data);

    }



}