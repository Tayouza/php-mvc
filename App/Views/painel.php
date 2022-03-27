<?php

if (!$login->logged()) { // Se não estiver logado redireciona para login
    header('Location: ' . PATH . 'login');
}
//echo '<pre>';
//var_dump($_SESSION);

?>

<div class="painel">
    <aside class="menu-lateral">
        <h2>Seja bem vindo <?php echo($_SESSION['nome'])  ?>!</h2>
    </aside>
    <section>

    

    </section>
</div>