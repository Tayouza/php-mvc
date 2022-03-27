<?php

namespace App\Core;

class Core{

    public function __construct(){
        $this->run();
    }

    public function run(){
        $params = array();

        // Se a url for setada armazena na variavel $url
        if(isset($_GET['url'])){
            $url = $_GET['url'];
        }

        //possui informacao apos dominio www.teste.com/classe/funcao/parametro
        if(!empty($url)){
            $url = explode('/', $url); //separa a url e cria um array
            $controller = $url[0].'Controller'; //armazena em uma variavel o tipo de controller
            
            array_shift($url); //remove a primeira posição do array para usar sempre a primeira posição

            //se o usuario enviou mais que a classe
            if(isset($url[0]) && !empty($url[0])){ //se o método não foi setado e não estiver vazio o método armazena o valor
                $method = $url[0];
                array_shift($url);
            }else{ //se não, define como o padrão o método index
                $method = 'index';
            }

            if(count($url) > 0){
                $params = $url;
            }

        }else{ // se não define o padrão inicial como a 'home'
            $controller = 'homeController';
            $method = 'index';
        }

        //armazena o namespace em uma variavel
        $controllerClassName = '\\App\\Controllers\\'.$controller;

        //verifica se a classe do controller existe, caso não exista define o controller de erro
        if(!class_exists($controllerClassName)){
            $controllerClassName = '\\App\\Controllers\\errorController';
            $method = 'index';
        }

        //verifica se a método do controller existe, caso não exista define o controller de erro
        if(!method_exists($controllerClassName, $method)){
            $controllerClassName = '\\App\\Controllers\\errorController';
            $method = 'index';
        }

        //instacia a classe do controller e chama os métodos e parametros
        $controllerClass = new $controllerClassName();
        $controllerClass->$method($params);
        

    }
    
}
