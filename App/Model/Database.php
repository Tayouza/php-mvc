<?php

namespace App\Model;

use PDO;
use Exception;

class Database
{

    private static $pdo;

    public static function getConnect()
    {

        if (!isset(self::$pdo)) {
            try {
                self::$pdo = new PDO("mysql: host=".HOST."; dbname=".DBNAME, USER, PASS);
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (Exception $e) {
                echo 'Erro: '.$e;
            }
        }
        
        return self::$pdo;
    }
}
