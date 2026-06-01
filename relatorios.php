<?php
require("cabecalho.php");
require("conexao.php");

$pedidos = [];

if (isset($_GET['inicio']) && isset($_GET['fim'])) {

    $inicio = $_GET['inicio'];
    $fim = $_GET['fim'];

    $stmt = $pdo->prepare("
        SELECT p.id, p.data, c.nome AS cliente, m.numero AS mesa
        FROM pedidos p
        JOIN clientes c ON c.id = p.id_cliente
        JOIN mesas m ON m.id = p.id_mesa
        WHERE p.data BETWEEN ? AND ?
        ORDER BY p.data ASC
    ");

    $stmt->execute([$inicio, $fim]);
    $pedidos = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<div class="container mt-4">

<h1>Relatório de Pedidos</h1>

<!-- FORMULÁRIO -->
<form method="get" class="row g-3 mb-4">

    <div class="col-md-5">
        <label>Data inicial</label>
        <input type="date" name="inicio" class="form-control" required>
    </div>

    <div class="col-md-5">
        <label>Data final</label>
        <input type="date" name="fim" class="form-control" required>
    </div>

    <div class="col-md-2 d-flex align-items-end">
        <button class="btn btn-primary w-100">
            Gerar
        </button>
    </div>

</form>

<!-- RESULTADO -->
<table class="table table-striped">

    <thead>
        <tr>
            <th>ID Pedido</th>
            <th>Cliente</th>
            <th>Mesa</th>
            <th>Data</th>
        </tr>
    </thead>

    <tbody>

        <?php if (count($pedidos) > 0): ?>

            <?php foreach ($pedidos as $p): ?>
                <tr>
                    <td><?= $p['id'] ?></td>
                    <td><?= $p['cliente'] ?></td>
                    <td>Mesa <?= $p['mesa'] ?></td>
                    <td><?= $p['data'] ?></td>
                </tr>
            <?php endforeach; ?>

        <?php else: ?>
            <tr>
                <td colspan="4" class="text-center">
                    Nenhum pedido encontrado
                </td>
            </tr>
        <?php endif; ?>

    </tbody>

</table>

</div>

<?php require("rodape.php"); ?>