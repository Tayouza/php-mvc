<form method="POST" class="d-flex justify-content-center">
    <div class="w-50">
        <div class="form-group">
            <label for="senhaAtual" class="sr-only">Senha Atual</label>
            <input type="password" name="senhaAtual" id="senhaAtual" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="novaSenha" class="sr-only">Nova Senha</label>
            <input type="password" name="novaSenha" id="novaSenha" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="confNovaSenha" class="sr-only">Confirmar Nova Senha</label>
            <input type="password" name="confNovaSenha" id="confNovaSenha" class="form-control" required>
        </div>
        <div class="btns">
            <input type="submit" name="trocar" value="Trocar" class="btn btn-success">
        </div>
    </div>
</form>

<?php

if (isset($_POST['trocar'])) {
    $senhaAtual = $_POST['senhaAtual'];
    $novaSenha = $_POST['novaSenha'];
    $confNovaSenha = $_POST['confNovaSenha'];

    if ($novaSenha !== $confNovaSenha) {
        echo '<div class="box-error">As senhas não conferem</div>';
    } else if (empty($novaSenha) && empty($novaSenha)) {
        echo '<div class="box-error">os campos devem ser preenchidos</div>';
    } else {
        $novaSenha = password_hash($novaSenha, PASSWORD_BCRYPT);
        echo($painel->changePass($id, $senhaAtual, $novaSenha));
    }
}
