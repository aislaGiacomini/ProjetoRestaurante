<?php
    require("cabecalho.php");
    require("conexao.php");
    if (isset($_POST['nome'])) {
        $nome = $_POST['nome'];
        $telefone = $_POST['telefone'];
        $sql = "INSERT INTO clientes ( nome, telefone) VALUES ('$nome', '$telefone')";
        $pdo->query($sql);
    }

?>
<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Cadastro de Clientes</h1>

        <a href="principal.php" class="btn btn-outline-secondary">
            ← Voltar
        </a>
    </div>
<form method="post">
    <div class="mb-3">
        <label for="nome" class="form-label">Informe o nome</label>
        <input id="nome" name="nome" class="form-control" rows="4" required=""></input>
    </div>
    <div class="mb-3">
        <label for="telefone" class="form-label">Informe o telefone</label>
        <input type="tel" id="telefone" name="telefone" class="form-control" required="">
    </div>
    <button type="submit" class="btn btn-primary">Enviar</button>
</form>
<?php

    $result = $pdo->query("SELECT * FROM clientes");
    $clientes = $result->fetchAll(PDO::FETCH_ASSOC);

?>


<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Telefone</th>
        </tr>
    </thead>

    <tbody>

    <?php foreach($clientes as $cliente): ?>

        <tr>
            <td><?= $cliente['id'] ?></td>
            <td><?= $cliente['nome'] ?></td>
            <td><?= $cliente['telefone'] ?></td>
            <td>
                <button
                        type="button"
                        class="btn btn-warning"
                        onclick="window.location.href='editarCliente.php?id=<?= $cliente['id'] ?>'">
                        Editar
                </button>
            </td>

        </tr>

    <?php endforeach; ?>

    </tbody>
</table>

<?php
    require("rodape.php");
?>