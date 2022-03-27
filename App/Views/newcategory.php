<div class="center-page">
    <form method="post" class="form-singin">
        <h1 class="h3 mb-3 font-weight-normal">Nova Categoria</h1>
        <div class="form-group">
            <label for="categoria" class="sr-only">Categoria</label>
            <input type="text" id="categoria" name="categoria" class="form-control" placeholder="Categoria" required autofocus>
        </div>
        <div class="btns">
            <input type="submit" class="btn btn-lg btn-primary btn-block" value="Inserir">
        </div>
    </form>
</div>

<?php

if(isset($_POST['categoria'])){
    $categoria = $_POST['categoria'];

    echo ($news->setCategory($categoria));
}

?>