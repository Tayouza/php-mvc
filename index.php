<?php

use App\Core\Core;

require "vendor/autoload.php";
require "config.php";

/* Instancia a Classe Core e no __contruct já chama o método run() para inicializar o MVC */
$core = new Core();

?>