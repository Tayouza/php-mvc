<div class="container center-page login">
    <form method="POST">
        <div class="dados-pessoais">
            <div class="form-row">
                <div class="form-group">
                    <label for="usuario">Nome</label>
                    <input type="text" class="form-control" id="fnome" name="fnome" placeholder="Nome" required>
                </div>
                <div class="form-group">
                    <label for="usuario">Sobrenome</label>
                    <input type="text" class="form-control" id="snome" name="snome" placeholder="Sobrenome" required>
                </div>
                <div class="form-group">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="idade">Idade</label>
                        </div>
                        <select class="custom-select" id="idade" name="idade" required>
                            <?php
                            for ($i = 15; $i < 100; $i++) {
                                echo "<option value=" . $i . ">" . $i . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="usuario">Endereco</label>
                    <input type="text" class="form-control" id="endereco" name="endereco" placeholder="Endereço" required>
                </div>
            </div>
        </div>
        <div class="dados-login">
            <div class="form-group">
                <label for="usuario">Usuário</label>
                <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Usuário" required>
            </div>
            <div class="form-group">
                <label for="senha">Senha</label>
                <input type="password" class="form-control" id="senha" name="senha" placeholder="Senha" required>
            </div>
            <div class="form-group">
                <label for="confSenha">Confirmar senha</label>
                <input type="password" class="form-control" id="confSenha" placeholder="Confirmar senha" required>
            </div>
        </div>
        <div class="form-row btns">
            <input type="submit" class="btn btn-primary" value="Registrar-se">
        </div>
    </form>


    <?php

    if (isset($_POST['senha'])) {
        $user = $_POST['usuario'];
        $pass = $_POST['senha'];
        $fname =  $_POST['fnome'];
        $sname = $_POST['snome'];
        $age = $_POST['idade'];
        $adress = $_POST['endereco'];


        echo ($login->singup($user, $pass, $fname, $sname, $age, $adress));
    }


    ?>

</div>