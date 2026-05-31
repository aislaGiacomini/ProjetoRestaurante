<?php
    require("cabecalho.php");
    require("conexao.php");
    if (isset($_POST['numero'])) {
        $numero = $_POST['numero'];
        $capacidade = $_POST['capacidade'];
        $sql = "INSERT INTO mesas (numero, capacidade) VALUES ('$numero', '$capacidade')";
        $pdo->query($sql);
    }

?>

<body class="bg-light">

<div class="container mt-5">
    <h1 class="mb-4">Cadastro de Mesas</h1>

    <!-- Formulário -->
    <form method="post" class="row g-3 mb-4">
        <div class="col-md-6">
            <label for="numero" class="form-label">Número da Mesa</label>
            <input type="number" id="numero" name="numero" class="form-control" required>
        </div>
        <div class="col-md-6">
            <label for="capacidade" class="form-label">Capacidade</label>
            <input type="number" id="capacidade" name="capacidade" class="form-control" required>
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-primary w-100">Cadastrar Mesa</button>
        </div>
    </form>
    <?php

        $result = $pdo->query("SELECT * FROM mesas");
        $mesas = $result->fetchAll(PDO::FETCH_ASSOC);

    ?>

    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Numero</th>
                <th>Capacidade</th>
            </tr>
        </thead>

    <tbody>

    <?php foreach($mesas as $mesa): ?>

        <tr>
            <td><?= $mesa['id'] ?></td>
            <td><?= $mesa['numero'] ?></td>
            <td><?= $mesa['capacidade'] ?></td>
            <td>
                <a href="editarMesa.php?id=<?= $mesa['id'] ?>"
                   class="btn btn-warning btn-sm">
                    Editar
                </a>

                <a href="excluirMesa.php?id=<?= $mesa['id'] ?>"
                   class="btn btn-danger btn-sm"
                   onclick="return confirm('Deseja realmente excluir este cliente?')">
                    Excluir
                </a>
            </td>

        </tr>

    <?php endforeach; ?>

    </tbody>
</table>

</body>
</html>
