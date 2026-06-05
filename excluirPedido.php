<?php
require("conexao.php");

$id = $_GET['id'];

try {

    $stmt = $pdo->prepare("SELECT id_pedido FROM pedido_itens WHERE id = ?");
    $stmt->execute([$id]);
    $item = $stmt->fetch(PDO::FETCH_ASSOC);

    $id_pedido = $item['id_pedido'];

    $stmt = $pdo->prepare("DELETE FROM pedido_itens WHERE id = ?");

    if($stmt->execute([$id])){
        header("Location: itensPedido.php?id_pedido=$id_pedido&excluir=true");
    } else {
        header("Location: itensPedido.php?id_pedido=$id_pedido&excluir=false");
    }

} catch(Exception $e){
    echo "Erro ao excluir: " . $e->getMessage();
}
