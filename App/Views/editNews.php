<?php
if ($login->logged()) :
    $titleNotice = $params[0];
    $idNotice = $params[1];
    $formatedtitleNotice = implode(' ', explode('-', $titleNotice));

    if (isset($_POST['titulo'])) {
        $titulo = $_POST['titulo'];
        $corpo = $_POST['corpo'];
        $categoria = $_POST['categoria'];
        $image = $_FILES['imagem'];

        $values = [
            "titulo" => $titulo,
            "texto" => $corpo,
            "categoria" => $categoria
        ];

        header("Location: " . PATH . "/news");

        echo ($news->updateNews($values, $idNotice));
    }

    if (!empty($titleNotice) && !empty($idNotice))
        $simpleNews = $news->getNewsByName($formatedtitleNotice, $idNotice);
    else
        header("Location: " . PATH . 'error');


    if ($simpleNews) :
?>

        <div class="center-page">
            <h2 class="h3 mb-3 font-weight-normal">Editar Notícia</h2>
            <div class="noticia-simples">
                <h4> <strong><?= $simpleNews['titulo'] ?></strong></h4>
                <img src="<?= $simpleNews['path'] ?>" class="img-noticia">
                <p class="texto-noticia"><?= $simpleNews['texto'] ?></p>
                <p class="categoria-news"> Categoria: <?= $simpleNews['nome_categoria'] ?></p>
            </div>


            <form method="post" class="form-singin" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="titulo" class="sr-only">Título</label>
                    <input type="text" value="<?= $simpleNews['titulo'] ?>" id="titulo" name="titulo" class="form-control" placeholder="Título" required autofocus>
                </div>
                <div class="form-group">
                    <label for="imagem" class="sr-only">Imagem</label>
                    <input type="file" value="<?= $simpleNews['path'] ?>" id="imagem" name="imagem" class="form-control">
                </div>
                <div class="form-group">
                    <label for="corpo" class="sr-only">Corpo</label>
                    <textarea id="corpo" name="corpo" class="form-control" placeholder="Corpo"><?= $simpleNews['texto'] ?></textarea>
                </div>
                <div class="form-group">
                    <label for="categoria" class="sr-only">Categoria</label>
                    <select name="categoria" id="categoria" class="form-select">
                        <?php
                        $category = $news->getCategory();

                        for ($i = 0; $i < count($category); $i++) {
                            if ($category[$i]['nome_categoria'] === $simpleNews['nome_categoria'])
                                echo '<option value="' . $category[$i]['id'] . '" selected>' . $category[$i]['nome_categoria'] . '</option>';
                            else
                                echo '<option value="' . $category[$i]['id'] . '">' . $category[$i]['nome_categoria'] . '</option>';
                        }

                        ?>
                    </select>
                </div>
                <div class="btns">
                    <a href="<?php echo PATH . 'painel/newcategory' ?>" class="btn btn-lg btn-warning btn-block">Nova Categoria</a>
                    <input type="submit" class="btn btn-lg btn-success btn-block" value="Alterar">
                </div>
            </form>
        </div>

    <?php
    else :
    ?>

        <div class="box-404">
            <h2>Notícia <span>não</span> encontrada</h2>
            <p>Volte a <a href="<?php echo PATH . 'news' ?>">página de notícias</a>!</p>
        </div>


    <?php
    endif;

else :

    ?>

    <div class="box-404">
        <h2>Você <span>não</span> pode acessar essa página</h2>
        <p>Volte a <a href="<?php echo PATH . 'news' ?>">página de notícias</a>!</p>
    </div>

<?php

endif;
?>