<?php

namespace App\Model;

use App\Model\Database;
use Exception;
use PDO;

class Login
{

    private $connect;

    public function __construct()
    {

        $this->connect = Database::getConnect();
    }

    public function login($user, $pass)
    {
        try {
            $pdo = $this->connect->query("SELECT * FROM logins WHERE user = '{$user}'");
            $result = $pdo->fetchAll(PDO::FETCH_ASSOC);
            if (!empty($result)) {
                extract($result[0]);
            } else {
                return '<div class="box-error">Usuário não encontrado</div>';
            }
        } catch (Exception $e) {
            return '<div class="box-error">Erro</div>';
        }

        if (password_verify($pass, $password)) {

            $pdo = $this->connect->query("SELECT * FROM usuarios WHERE id_login = '{$id}'");
            $result = $pdo->fetchAll(PDO::FETCH_ASSOC);
            extract($result[0]);
            foreach ($result[0] as $key => $value) {
                $_SESSION["{$key}"] = $value;
            }
            $_SESSION['logged'] = true;

            header("Location: " . PATH . "painel");
        } else {
            return '<div class="box-error">Senha incorreta</div>';
        }
    }

    public function logged()
    {

        return !empty($_SESSION['logged']) ?? $_SESSION['logged'];
    }

    public function logout()
    {
        session_destroy();
    }

    public function singup($username, $pass, $fname, $sname, $age, $adress)
    {
        try {
            //Registrando na tabela logins
            $pdo = $this->connect->query("SELECT * FROM logins WHERE user = '{$username}'");

            if ($pdo->rowCount() == 0) {
                $query = ("INSERT INTO logins(user, password) VALUES (?,?)");

                $newPass = password_hash($pass, PASSWORD_BCRYPT);

                try {
                    $pdo = $this->connect->prepare($query);
                    $pdo->execute(array($username, $newPass));
                } catch (Exception $e) {
                    return '<div class="box-error">Ocorreu um erro!</div>';
                }
            } else {
                return '<div class="box-error">Usuário já registrado</div>';
            }
        } catch (Exception $e) {
            return '<div class="box-error">Ocorreu um erro!</div>';
        }

        //registrando na tabela usuarios
        $pdo = $this->connect->query("SELECT id FROM logins WHERE user = '{$username}'");
        $result = $pdo->fetchAll(PDO::FETCH_ASSOC);
        $id = $result[0]['id'];

        try {
            $query = ("INSERT INTO usuarios(nome, sobrenome, idade, endereco, id_login) VALUES (?,?,?,?,?)");
            $pdo = $this->connect->prepare($query);
            $pdo->execute(array($fname, $sname, $age, $adress, $id));
        } catch (Exception $e) {
            return '<div class="box-error">Ocorreu um erro!</div>';
        }

        return '<div class="box-success">Usuário Registrado com sucesso!</div>';
    }

}
