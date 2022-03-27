<h2 class="center-page my-3">Alterar dados</h2>
<form method="POST" class="d-flex justify-content-center">
    <div class="w-50">
        <div class="form-group">
            <label for="nome" class="sr-only">Nome: </label>
            <input type="text" value="<?= $_SESSION['nome'] ?>" name="nome" id="nome" class="form-control">
        </div>
        <div class="form-group">
            <label for="sobrenome" class="sr-only">Sobrenome: </label>
            <input type="text" value="<?= $_SESSION['sobrenome'] ?>" name="sobrenome" id="sobrenome" class="form-control">
        </div>
        <div class="form-group">
            <label for="idade" class="sr-only">Idade</label>
            <input type="text" value="<?= $_SESSION['idade'] ?>" name="idade" id="idade" class="form-control">
        </div>
        <div class="form-group">
            <label for="Endereco" class="sr-only">Endereço</label>
            <input type="text" value="<?= $_SESSION['endereco'] ?>" name="endereco" id="endereco" class="form-control">
        </div>
        <div class="form-group">
            <input type="submit" value="Trocar" name="trocar" class="form-control btn-success my-1">
        </div>
    </div>
</form>

<?php

if (isset($_POST['trocar'])) {

    $fields = [
        'nome' => $_POST['nome'],
        'sobrenome' => $_POST['sobrenome'],
        'idade' => $_POST['idade'],
        'endereco' => $_POST['endereco']
    ];

    echo($painel->updatePersonalData($_SESSION['id'], $fields));
    
    header('Location: '.PATH.'/painel/dadospessoais');
}

?>