<?php

namespace App\Controllers;

use App\Core\Controller;

class homeController extends Controller
{

    public function index()
    {
        /*
        1) chamar model
        2) chamar view
        3) unir back end com front end
        */


        $this->loadTemplate('home');
    }
}
