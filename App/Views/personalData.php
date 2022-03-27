<div class="center-page d-flex flex-row justify-content-between">
    <table>
        <tr>
            <td>Nome: </td>
            <td><?php echo $_SESSION['nome'] . ' ' . $_SESSION['sobrenome']; ?></td>
        </tr>
        <tr>
            <td>Idade: </td>
            <td><?php echo $_SESSION['idade']; ?></td>
        </tr>
        <tr>
            <td>Endereço: </td>
            <td><?php echo $_SESSION['endereco']; ?></td>
        </tr>
    </table>
    <div class="btns">
        <a class="btn-success btn" href="<?php echo PATH . 'painel/dadospessoais/edit' ?>">Editar</a>
    </div>
</div>

