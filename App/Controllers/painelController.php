<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Model\Painel;
use App\Model\Login;
use App\Model\News;

class painelController extends Controller
{

    public function index()
    {

        $data['login'] = new Login();

        $this->loadTemplate('painel', $data);
    }

    public function newnotice()
    {
        $data['news'] = new News();

        if (isset($_SESSION['logged'])) {
            $this->loadTemplate('newnotice', $data);
        } else {
            header('Location: ' . PATH . 'error');
        }
    }

    public function newcategory()
    {

        $data['news'] = new News();

        if (isset($_SESSION['logged'])) {
            $this->loadTemplate('newcategory', $data);
        }
    }

    public function logout()
    {

        if (isset($_SESSION['logged'])) {

            $logout = new Login();

            $logout->logout();

            $this->loadTemplate('logout');
        } else {
            header('Location: ' . PATH . 'error');
        }
    }

    public function dadospessoais($param = null)
    {
        if (empty($param)) {
            if (isset($_SESSION['logged'])) {
                $this->loadTemplate('personalData');
            } else {
                header('Location: ' . PATH . 'error');
            }
        }
        
        if(!empty($param[0]) && $param[0] === 'edit'){
            if (isset($_SESSION['logged'])) {
                $data['painel'] = new Painel();

                $this->loadTemplate('editPersonalData', $data);
            } else {
                header('Location: ' . PATH . 'error');
            }
        }
    }

    public function alterarsenha(){

        $data['painel'] = new Painel;
        $data['id'] = $_SESSION['id'];

        $this->loadTemplate('changepassword', $data);

    }
}
