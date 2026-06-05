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
    <div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Cadastro de Mesas</h1>

        <a href="principal.php" class="btn btn-outline-secondary">
            ← Voltar
        </a>
    </div>

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
            <td><?= $mesa['numero'] ?></td>
            <td><?= $mesa['capacidade'] ?></td>
            <td>
                <button
                        type="button"
                        class="btn btn-warning"
                        onclick="window.location.href='editarMesa.php?id=<?= $mesa['id'] ?>'">
                        Editar
                </button>
            </td>

        </tr>

    <?php endforeach; ?>

    </tbody>
</table>

</body>
</html>
