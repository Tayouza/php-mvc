<div class="center-page">
    <form method="post" class="form-singin" enctype="multipart/form-data">
        <h1 class="h3 mb-3 font-weight-normal">Nova Notícia</h1>
        <div class="form-group">
            <label for="titulo" class="sr-only">Título</label>
            <input type="text" id="titulo" name="titulo" class="form-control" placeholder="Título" required autofocus>
        </div>
        <div class="form-group">
            <label for="imagem" class="sr-only">Imagem</label>
            <input type="file" id="imagem" name="imagem" accept="image/x-png,image/jpeg,image/bmp" class="form-control">
        </div>
        <div class="form-group">
            <label for="corpo" class="sr-only">Corpo</label>
            <textarea id="corpo" name="corpo" class="form-control" placeholder="Corpo" required></textarea>
        </div>
        <div class="form-group">
            <label for="categoria" class="sr-only">Categoria</label>
            <select name="categoria" id="categoria" class="form-select">
                <?php
                $category = $news->getCategory();

                for ($i = 0; $i < count($category); $i++) {
                    echo '<option value="' . $category[$i]['id'] . '">' . $category[$i]['nome'] . '</option>';
                }

                ?>
            </select>
        </div>
        <div class="btns">
            <a href="<?php echo PATH . 'painel/newcategory' ?>" class="btn btn-lg btn-warning btn-block">Nova Categoria</a>
            <input type="submit" class="btn btn-lg btn-success btn-block" value="Inserir">
        </div>
    </form>
</div>

<?php

if (isset($_POST['titulo'])) {
    $titulo = $_POST['titulo'];
    $archive = $_FILES['imagem'];
    $corpo = $_POST['corpo'];
    $categoria = $_POST['categoria'];
    $nameArchive = $archive['name'];
    $newNameArchive = md5(uniqid());
    $folder = 'c:/xampp/htdocs/mvc/archives/';
    $extension = strtolower(pathinfo($nameArchive, PATHINFO_EXTENSION));
    $pathDir = $folder . $newNameArchive . '.' . $extension;

    if ($extension != 'jpg' && $extension != 'jpeg' && $extension != 'bmp' && $extension != 'png') {
        die("<p class=\"box-error\">Este tipo de arquivo não é suportado</p>");
    }

    try {
        $accept = move_uploaded_file($archive['tmp_name'], $pathDir);
    } catch (Exception $e) {
        echo '<div class="box-error">Imagem não guardada</div>';
    }

    if ($accept) {
        $pathWeb = PATH.'archives/'.$newNameArchive.'.'.$extension;
        try {
            $news->insertImage($nameArchive, $newNameArchive, $pathWeb);
            echo ($newNews = $news->setNews($titulo, $newNameArchive, $corpo, $categoria));
        } catch (Exception $e) {
            echo '<div class="box-error">Ocorreu um erro!</div>';
        }
    } else {
        echo '<p class="box-error">A noticia não foi registrada</p>';
    }
}
