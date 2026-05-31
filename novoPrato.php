<?php
    require("cabecalho.php");
    require("conexao.php");
    if (isset($_POST['nome'])) {
        $nome = $_POST['nome'];
        $preco = $_POST['preco'];
        $descricao = $_POST['descricao'];
        $sql = "INSERT INTO pratos (nome, preco, descricao) VALUES ('$nome', '$preco', '$descricao')";
        $pdo->query($sql);
    }
    
?>

<h1>Novo Prato</h1>
<form method="post">
    <div class="mb-3">
        <label for="nome" class="form-label">Informe o nome</label>
        <input id="nome" name="nome" class="form-control" rows="4" required=""></input>
    </div>
    <div class="mb-3">
        <label for="descricao" class="form-label">Informe a descrição</label>
        <textarea id="descricao" name="descricao" class="form-control" rows="4" required=""></textarea>
    </div>
    <div class="mb-3">
        <label for="valor" class="form-label">Informe o preço</label>
        <input type="number" id="preco" name="preco" class="form-control" required="">
    </div>
    <button type="submit" class="btn btn-primary">Enviar</button>
</form>
<?php

$result = $pdo->query("SELECT * FROM pratos");
$pratos = $result->fetchAll(PDO::FETCH_ASSOC);

?>


<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Descrição</th>
            <th>Preço</th>
            <th>Ações</th>
        </tr>
    </thead>

    <tbody>

    <?php foreach($pratos as $prato): ?>

        <tr>
            <td><?= $prato['id'] ?></td>
            <td><?= $prato['nome'] ?></td>
            <td><?= $prato['descricao'] ?></td>
            <td>R$ <?= number_format($prato['preco'], 2, ',', '.') ?></td>

            <td>
                <a href="editarPrato.php?id=<?= $prato['id'] ?>"
                   class="btn btn-warning btn-sm">
                    Editar
                </a>

                <a href="excluirPrato.php?id=<?= $prato['id'] ?>"
                   class="btn btn-danger btn-sm"
                   onclick="return confirm('Deseja realmente excluir este prato?')">
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