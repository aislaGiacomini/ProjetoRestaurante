<?php
require("cabecalho.php");
require("conexao.php");

$clientes = $pdo->query("SELECT * FROM clientes")->fetchAll(PDO::FETCH_ASSOC);
$mesas = $pdo->query("SELECT * FROM mesas")->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $id_cliente = $_POST['id_cliente'];
    $id_mesa = $_POST['id_mesa'];
    $data = date('Y-m-d');

    // 1. cria o pedido
    $stmt = $pdo->prepare("
        INSERT INTO pedidos (id_cliente, id_mesa, data)
        VALUES (?, ?, ?)
    ");

    $stmt->execute([$id_cliente, $id_mesa, $data]);

    // 2. pega o ID do pedido criado
    $id_pedido = $pdo->lastInsertId();

    // 3. vai para itens do pedido
    header("Location: itensPedido.php?id_pedido=$id_pedido");
    exit;
}
?>

<div class="container mt-4">

<h1>Novo Pedido</h1>

<form method="post">

    <div class="mb-3">
        <label>Cliente</label>
        <select name="id_cliente" class="form-control" required>
            <option value="">Selecione</option>
            <?php foreach($clientes as $c): ?>
                <option value="<?= $c['id'] ?>">
                    <?= $c['nome'] ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="mb-3">
        <label>Mesa</label>
        <select name="id_mesa" class="form-control" required>
            <option value="">Selecione</option>
            <?php foreach($mesas as $m): ?>
                <option value="<?= $m['id'] ?>">
                    Mesa <?= $m['numero'] ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <button class="btn btn-primary">Criar Pedido</button>

</form>

</div>

<?php require("rodape.php"); ?>