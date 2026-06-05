<?php
    require("cabecalho.php");
    require("conexao.php");
    if (isset($_POST['nome'])) { #Verificar se True
        $nome = $_POST['nome'];
        $preco = $_POST['preco'];
        $descricao = $_POST['descricao'];
        $sql = "INSERT INTO pratos (nome, preco, descricao) VALUES ('$nome', '$preco', '$descricao')";
        $pdo->query($sql);
    }
    
?>
<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Novo prato</h1>

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

    $result = $pdo->query("SELECT * FROM pratos"); #Pesquisa no banco
    $pratos = $result->fetchAll(PDO::FETCH_ASSOC); #Faz o array

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
                <button
                        type="button"
                        class="btn btn-warning"
                        onclick="window.location.href='editarPrato.php?id=<?= $prato['id'] ?>'">
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