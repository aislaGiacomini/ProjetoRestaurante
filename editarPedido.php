<?php
require("cabecalho.php");
require("conexao.php");

if (!isset($_GET['id'])) {
    die("ID não informado.");
}

$id = $_GET['id'];

$stmt = $pdo->prepare("
    SELECT *
    FROM pedido_itens
    WHERE id = ?
");
$stmt->execute([$id]);
$item = $stmt->fetch(PDO::FETCH_ASSOC);

$pratos = $pdo->query("
    SELECT *
    FROM pratos
")->fetchAll(PDO::FETCH_ASSOC);

if($_SERVER['REQUEST_METHOD'] == "POST"){

    $id = $_POST['id'];
    $id_prato = $_POST['id_prato'];
    $quantidade = $_POST['quantidade'];

    // busca o preço do prato selecionado
    $stmt = $pdo->prepare("
        SELECT preco
        FROM pratos
        WHERE id = ?
    ");

    $stmt->execute([$id_prato]);

    $prato = $stmt->fetch(PDO::FETCH_ASSOC);

    $preco = $prato['preco'];

    // atualiza item
    $stmt = $pdo->prepare("
        UPDATE pedido_itens
        SET id_prato = ?,
            quantidade = ?,
            preco = ?
        WHERE id = ?
    ");

    if($stmt->execute([$id_prato, $quantidade, $preco, $id])){

        header("Location: itensPedido.php?id_pedido=".$item['id_pedido']);
        exit;

    }else{

        echo "<div class='alert alert-danger'>
                Erro ao atualizar.
              </div>";
    }
}
?>

<h1>Editar Item do Pedido</h1>

<form method="post">

    <input type="hidden"
           name="id"
           value="<?= $item['id'] ?>">

    <div class="mb-3">
        <label class="form-label">Prato</label>

        <select name="id_prato"
                class="form-control">

            <?php foreach($pratos as $p): ?>

                <option
                    value="<?= $p['id'] ?>"
                    <?= $p['id'] == $item['id_prato'] ? 'selected' : '' ?>>

                    <?= $p['nome'] ?>

                </option>

            <?php endforeach; ?>

        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">
            Quantidade
        </label>

        <input type="number"
               name="quantidade"
               class="form-control"
               min="1"
               value="<?= $item['quantidade'] ?>">
    </div>

    <button class="btn btn-primary">
        Salvar Alterações
    </button>

</form>

<?php require("rodape.php"); ?>