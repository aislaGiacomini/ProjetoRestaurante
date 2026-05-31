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

<h1>Novo cliente</h1>
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
                <a href="editarCliente.php?id=<?= $cliente['id'] ?>"
                   class="btn btn-warning btn-sm">
                    Editar
                </a>

                <a href="excluirCliente.php?id=<?= $cliente['id'] ?>"
                   class="btn btn-danger btn-sm"
                   onclick="return confirm('Deseja realmente excluir este cliente?')">
                    Excluir
                </a>
            </td>

        </tr>

    <?php endforeach; ?>

    </tbody>
</table>

<?php
    require("rodape.php");
?>