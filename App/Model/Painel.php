<?php

namespace App\Model;

use Exception;
use PDO;

class Painel
{

    private $connect;

    public function __construct()
    {

        $this->connect = Database::getConnect();
    }

    public function updatePersonalData($where, $values)
    {

        $fields = array_keys($values);
        $inputValues = array_values($values);


        $query = ("UPDATE usuarios SET " . implode('=?,', $fields) . "=? WHERE id=" . $where);

        try {
            $pdo = $this->connect->prepare($query);
            $pdo->execute($inputValues);

            foreach ($values as $key => $value) {
                $_SESSION["{$key}"] = $value;
            }

            return '<div class="box-success">Dados alterados com sucesso!</div>';
        } catch (Exception $e) {
            return '<div class="box-error">Ocorreu um erro!</div>';
        }
    }

    public function changePass($id, $oldPass, $newPass)
    {

        $query = ("SELECT password FROM logins WHERE id = $id");

        try {
            $pdo = $this->connect->query($query);
            $result = $pdo->fetch(PDO::FETCH_ASSOC);

            if (!password_verify($oldPass, $result['password'])) {
                return '<div class="box-error">Senha atual incorreta</div>';
            }

            $query = ("UPDATE logins SET password = ? WHERE id = ?");

            $pdo = $this->connect->prepare($query);
            $pdo->execute(array($newPass, $id));

            return '<div class="box-success">Senha alterada com sucesso!</div>';

        } catch (Exception $e) {
            return '<div class="box-error">Ocorreu um erro!</div>';
        }
    }
}
