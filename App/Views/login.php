<div class="container login center-page">
    <form class="form-signin" method="POST">
        <h1 class="h3 mb-3 font-weight-normal">Faça login</h1>
        <label for="usuario" class="sr-only">Usuário</label>
        <input type="text" id="usuario" name="usuario" class="form-control" placeholder="Usuário" required autofocus>
        <label for="pass" class="sr-only">Senha</label>
        <input type="password" id="pass" name="pass" class="form-control" placeholder="Senha" required>
        <div class="btns">
            <input type="submit" class="btn btn-lg btn-primary btn-block" value="Login">
        </div>
    </form>
    <?php

    if (isset($_POST['usuario'])) {
        $user = $_POST['usuario'];
        $pass = $_POST['pass'];

        echo ($login->login($user, $pass));
    }

    ?>
</div>