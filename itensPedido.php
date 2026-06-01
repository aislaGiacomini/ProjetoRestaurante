<?php
require("cabecalho.php");
require("conexao.php");

$id_pedido = $_GET['id_pedido'];

$pratos = $pdo->query("SELECT * FROM pratos")->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $id_pedido = $_POST['id_pedido'];
    $id_prato = $_POST['id_prato'];
    $quantidade = $_POST['quantidade'];


    $stmt = $pdo->prepare("SELECT preco FROM pratos WHERE id = ?");
    $stmt->execute([$id_prato]);
    $prato = $stmt->fetch(PDO::FETCH_ASSOC);

    $preco = $prato['preco'];

    // salva item
    $stmt = $pdo->prepare("
        INSERT INTO pedido_itens (id_pedido, id_prato, quantidade, preco)
        VALUES (?, ?, ?, ?)
    ");

    $stmt->execute([$id_pedido, $id_prato, $quantidade, $preco]);

    header("Location: itensPedido.php?id_pedido=$id_pedido&sucesso=true");
    exit;
}

$stmt = $pdo->prepare("
    SELECT ip.*, p.nome
    FROM pedido_itens ip
    JOIN pratos p ON p.id = ip.id_prato
    WHERE ip.id_pedido = ?
");
$stmt->execute([$id_pedido]);
$itens = $stmt->fetchAll(PDO::FETCH_ASSOC);
$total = 0;

foreach ($itens as $i) {
    $total += $i['quantidade'] * $i['preco'];
}
?>

<div class="container mt-4">

<h1>Itens do Pedido #<?= $id_pedido ?></h1>

<?php if (isset($_GET['sucesso'])): ?>
    <div class="alert alert-success">
        Item adicionado!
    </div>
<?php endif; ?>

<form method="post">

    <input type="hidden" name="id_pedido" value="<?= $id_pedido ?>">

    <div class="mb-3">
        <label>Prato</label>
        <select name="id_prato" class="form-control" required>
            <option value="">Selecione</option>
            <?php foreach($pratos as $p): ?>
                <option value="<?= $p['id'] ?>">
                    <?= $p['nome'] ?> - R$ <?= $p['preco'] ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="mb-3">
        <label>Quantidade</label>
        <input type="number" name="quantidade" class="form-control" min="1" required>
    </div>

    <button class="btn btn-success">Adicionar Item</button>

</form>
<h3 class="mt-4">Itens do Pedido</h3>

<table class="table table-striped">
    <thead>
        <tr>
            <th>Prato</th>
            <th>Quantidade</th>
            <th>Preço</th>
            <th>Subtotal</th>
        </tr>
    </thead>

    <tbody>
        <?php 
            foreach ($itens as $item): ?>
            <tr>
                <td><?= $item['nome'] ?></td>
                <td><?= $item['quantidade'] ?></td>
                <td>R$ <?= number_format($item['preco'], 2, ',', '.') ?></td>
                <td>
                    R$ <?= number_format($item['quantidade'] * $item['preco'], 2, ',', '.') ?>
                </td>
                <td>
                    <a href="editarPedido.php?id=<?= $p['id'] ?>" 
                    class="btn btn-warning btn-sm">
                        Editar
                    </a>

                    <a href="excluirPedido.php?id=<?= $p['id'] ?>" 
                    class="btn btn-danger btn-sm"
                    onclick="return confirm('Deseja realmente excluir este pedido?')">
                        Excluir
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<h4 class="text-end">
    Total: R$ <?= number_format($total, 2, ',', '.') ?>
</h4>


<?php require("rodape.php"); ?>