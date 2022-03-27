<?php
if (isset($_GET['busca'])) {
    $busca = $_GET['busca'];
    $buscaFormated = implode('%3F', explode('?', implode('%2C', explode(',', implode('-', (explode(' ', strtolower($busca))))))));
    header('Location: ' . PATH . 'news/busca/' . $buscaFormated);
}
?>
<article class="ordem-noticia">
    <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
            Ordenar
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
            <li><a class="dropdown-item" href="/mvc/news/categoria/geral">Todas</a></li>
            <?php
            $categorias = $news->getCategory();
            foreach ($categorias as $value) {
                echo '<li><a class="dropdown-item" href="/mvc/news/categoria/' . preg_replace(array("/(á|à|ã|â|ä)/", "/(Á|À|Ã|Â|Ä)/", "/(é|è|ê|ë)/", "/(É|È|Ê|Ë)/", "/(í|ì|î|ï)/", "/(Í|Ì|Î|Ï)/", "/(ó|ò|õ|ô|ö)/", "/(Ó|Ò|Õ|Ô|Ö)/", "/(ú|ù|û|ü)/", "/(Ú|Ù|Û|Ü)/", "/(ñ)/", "/(Ñ)/", "/(ç)/", "/(Ç)/"), explode(" ", "a A e E i I o O u U n N ç Ç"), implode('-', (explode(' ', strtolower($value['nome_categoria']))))) . '">' . $value['nome_categoria'] . '</a></li>';
            }
            ?>
        </ul>
    </div>
    <div class="pesquisar-noticia">
        <form class="row g-2" method="GET">
            <div class="col-md-8">
                <input type="text" name="busca" class="form-control" placeholder="Procure uma noticia">
            </div>
            <div class="col-md-4">
                <input type="submit" class="form-control btn-primary" value="Pesquisar">
            </div>
        </form>
    </div>
</article>
<article class="exibir-procura">
    <h2>Você pesquisou por: "<?= explode('/', $_GET['url'])[2] ?>"</h2>
</article>

<article class="lista-noticia">
    <?php
    $titleFormated = implode('?', explode('%3F', implode(',', explode('%2C', implode(' ', (explode('-', strtolower($title))))))));
    $listNews = $news->getNewsByTitle($titleFormated);
    if (empty($listNews) || !$listNews) {
        echo '
        <div class="box-404">
            <h2>Não encontramos nada 😥</h2>
            <p>Volte a <a href="' . PATH . 'news">página de notícias</a>!</p>
        </div>
        ';
    } else {
        for ($n = 0; $n < count($listNews); $n++) {

            $formatedNameNews = implode('%3F', explode('?', implode('%2C', explode(',', implode('-', (explode(' ', strtolower($listNews[$n]['titulo']))))))));

            echo '    
                <div class="noticia-simples">
                    <h4> <strong>' . $listNews[$n]['titulo'] . '</strong></h4>
                    <a href="'.PATH.'news/simple/'.$formatedNameNews.'/'.$listNews[$n]['id'].'"><img src="' . $listNews[$n]['path'] . '" class="img-noticia"></a>
                    <p class="texto-noticia">' . $listNews[$n]['texto'] . '</p>';

            if (isset($_SESSION['logged']) && $_SESSION['logged']) {
                echo '<a class="btn-warning btn editar-noticia" href="' . PATH . 'news/edit/' . $formatedNameNews . '/' . $listNews[$n]['id'] . '"> Editar...</a>';
            }

            echo '<p class="categoria-news"> Categoria: ' . $listNews[$n]['nome_categoria'] . '</p>
                </div>
                ';
        }
    }
    ?>
</article>