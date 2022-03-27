<?php

namespace App\Views;

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo PATH . 'style/style.css' ?>">
    <link rel="stylesheet" href="<?php echo PATH . 'style/painel.css' ?>">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <title>MVC</title>
</head>

<body>

    <div class="container">
        <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-1 border-bottom">
            <a href="<?php echo PATH . 'home' ?>" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
                <strong>TayouzaDev MVC </strong>
            </a>

            <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
                <li><a href="<?php echo PATH . 'home' ?>" class="nav-link px-2 link-dark">Home</a></li>
                <li><a href="<?php echo PATH . 'news' ?>" class="nav-link px-2 link-dark">Noticias</a></li>
                <li><a href="#footer" class="nav-link px-2 link-dark">Sobre</a></li>
            </ul>

            <div class="col-md-5 text-end">
                <?php
                if (!isset($_SESSION['logged'])) {
                    echo '<a href="' . PATH . 'login' . '" class="btn btn-outline-primary me-2">Login</a>';
                    echo '<a href="' . PATH . 'login/singup' . '" class="btn btn-primary">Sign-up</a>';
                } else {
                    echo '<a href="' . PATH . 'painel' . '" class="btn btn-success me-2">Painel</a>';
                    echo '<a href="' . PATH . 'painel/newnotice' . '" class="btn btn-warning me-2">Nova notícia</a>';
                    echo '<a href="' . PATH . 'painel/logout' . '" class="btn btn-danger me-2">Logout</a>';
                }

                ?>
            </div>
        </header>


        <?php
        if (isset($_SESSION['logged']) && explode('/', $_GET['url'])[0] === 'painel') {
            echo '
            <header class="d-flex justify-content-center py-1 mb-4 border-bottom">
                <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
                    <li><a href="' . PATH . 'painel" class="nav-link px-2 link-dark">Painel</a></li>
                    <li><a href="' . PATH . 'painel/dadospessoais" class="nav-link px-2 link-dark">Dados Pessoais</a></li>
                    <li><a href="' . PATH . 'painel/alterarsenha" class="nav-link px-2 link-dark">Trocar senha</a></li>
                </ul>
            </header>';
        }

        ?>


    </div>

    <main class="container">
        <?php

        //recebe o valor passado como parametro no $variavel.'Controller' e carrega a view de acordo com o parametro
        $this->loadView($nameView, $data);

        ?>
    </main>

    <div class="container" id="footer">
        <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
            <div class="col-md-4 d-flex align-items-center">
                <span class="text-muted">&copy; 2022 Tayouza, Dev</span>
            </div>

            <ul class="nav col-md-4 justify-content-end list-unstyled d-flex">
                <li class="ms-3">
                    <a class="text-muted" href="https://www.linkedin.com/in/tayouzadev/" target="_blank">
                        <i class="bi-linkedin" width="24" height="24"></i>
                    </a>
                </li>
                <li class="ms-3">
                    <a class="text-muted" href="https://www.instagram.com/tayouza_" target="_blank">
                        <i class="bi-instagram" width="24" height="24"></i>
                    </a>
                </li>
                <li class="ms-3">
                    <a class="text-muted" href="https://www.facebook.com/taylor.souza.758" target="_blank">
                        <i class="bi-facebook" width="24" height="24"></i>
                    </a>
                </li>
            </ul>
        </footer>
    </div>

    <script>
        //manter o footer na parte de baixo
        if (document.querySelector('main.container').clientHeight > 800) {
            document.querySelector('#footer').style.position = 'relative';
            document.querySelector('#footer').style.left = '0';
            document.querySelector('#footer').style.transform = 'translateX(0)';
        }

        //aumentar textarea automaticamente
        let textCorpo = document.querySelector('#corpo');
        if (textCorpo) {

            textCorpo.onkeyup = function() {
                if (textCorpo.scrollHeight > textCorpo.offsetHeight) {
                    textCorpo.rows += 1;
                }
            }

        }
    </script>
</body>

</html>