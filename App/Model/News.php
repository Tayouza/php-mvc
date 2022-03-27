<?php

namespace App\Model;

use App\Model\Database;
use Exception;
use PDO;

class News
{

    private $connect;

    public function __construct()
    {

        $this->connect = Database::getConnect();
    }

    public function getNews()
    {
        $query = "SELECT n.*, cat.nome_categoria, imgNews.path
        FROM noticias AS n
        INNER JOIN categoria_noticia AS cat
        ON n.categoria = cat.id
        INNER JOIN imagem_noticia AS imgNews
        ON n.imagem = imgNews.nome_arquivo
        ORDER BY n.`id` DESC";

        try {
            $query = $this->connect->query($query);

            $data = $query->fetchAll(PDO::FETCH_ASSOC);

            return $data;
        } catch (Exception $e) {
            return '<div class="box-error">Ocorreu um erro!</div>';
        }
    }

    public function setNews($titulo, $imagem, $texto, $categoria)
    {

        $query = ("INSERT INTO `noticias`(titulo,imagem,texto,categoria) VALUES (?,?,?,?)");

        try {

            $pdo = $this->connect->prepare($query);
            $pdo->execute(array($titulo, $imagem, $texto, $categoria));

            return '<div class="box-success">Notícia registrada com sucesso!</div>';
        } catch (Exception $e) {
            return '<div class="box-error">Ocorreu um erro!</div>';
        }
    }

    public function updateNews($values, $id)
    {
        $fields = array_keys($values);
        $inputValues = array_values($values);

        $query = ("UPDATE noticias SET " . implode('=?,', $fields) . "=? WHERE id = " . $id);

        $pdo = $this->connect->prepare($query);
        $pdo->execute($inputValues);

        return '<div class="box-success">Notícia alterada com sucesso!</div>';
    }

    public function getCategory()
    {
        $query = ("SELECT * FROM `categoria_noticia`");
        try {
            $data = $this->connect->query($query);
            $data = $data->fetchAll(PDO::FETCH_ASSOC);

            return $data;
        } catch (Exception $e) {
            return '<div class="box-error">Ocorreu um erro!</div>';
        }
    }

    public function setCategory($nome)
    {
        $query = ("INSERT INTO `categoria_noticia`(nome) VALUES (?)");

        try {
            $pdo = $this->connect->prepare($query);
            $pdo->execute(array($nome));

            return '<div class="box-success">Categoria registrada com sucesso!</div>';
        } catch (Exception $e) {
            return '<div class="box-error">Ocorreu um erro!</div>';
        }
    }

    public function insertImage($nome, $nameArchive, $path)
    {

        $query = ("INSERT INTO imagem_noticia(nome,nome_arquivo,path) VALUES (?,?,?)");

        try {
            $pdo = $this->connect->prepare($query);
            $pdo->execute(array($nome, $nameArchive, $path));
        } catch (Exception $e) {
            return '<div class="box-error">Ocorreu um erro!</div>';
        }
    }

    public function getImage()
    {
        $query = ("SELECT * FROM imagem_noticia");

        try {
            $pdo = $this->connect->query($query);
            $pdo = $pdo->fetchAll(PDO::FETCH_ASSOC);

            return $pdo;
        } catch (Exception $e) {
            return '<div class="box-error">Ocorreu um erro!</div>';
        }
    }

    public function getNewsByName($title, $id)
    {

        $query = ("SELECT n.*, cat.nome_categoria, imgNews.path
        FROM noticias as n
        INNER JOIN categoria_noticia as cat
        ON n.categoria = cat.id
        INNER JOIN imagem_noticia as imgNews
        ON n.imagem = imgNews.nome_arquivo
        WHERE titulo = '{$title}' AND n.id = '{$id}'");

        $pdo = $this->connect->query($query);
        $result = $pdo->fetch(PDO::FETCH_ASSOC);

        return $result;
    }

    public function getNewsByCategory($nameCategory)
    {
        $nameCategory = $nameCategory === 'geral' ? '%%' : $nameCategory;

        $query = ("SELECT n.*, cat.nome_categoria, imgNews.path
        FROM noticias as n
        INNER JOIN categoria_noticia as cat
        ON n.categoria = cat.id
        INNER JOIN imagem_noticia as imgNews
        ON n.imagem = imgNews.nome_arquivo
        WHERE cat.nome_categoria LIKE '{$nameCategory}'
        ORDER BY n.id DESC");

        $pdo = $this->connect->query($query);
        $result = $pdo->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    public function getNewsByTitle($search)
    {
        if (!empty($search)) {
            $query = ("SELECT n.*, cat.nome_categoria, imgNews.path
                        FROM noticias as n
                        INNER JOIN categoria_noticia as cat
                        ON n.categoria = cat.id
                        INNER JOIN imagem_noticia as imgNews
                        ON n.imagem = imgNews.nome_arquivo
                        WHERE n.titulo LIKE '%{$search}%'
                        ORDER BY n.id DESC
                        ");

            $pdo = $this->connect->query($query);
            $result = $pdo->fetchAll(PDO::FETCH_ASSOC);

            return $result;
        }else{
            return false;
        }
    }
}
