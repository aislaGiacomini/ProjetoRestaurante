<?php
require("conexao.php");

$id = $_GET['id'];

try {

    $stmt = $pdo->prepare("DELETE FROM clientes WHERE id = ?");

    if($stmt->execute([$id])){
        header("Location: novoCliente.php?excluir=true");
    } else {
        header("Location: novoCliente.php?excluir=false");
    }

} catch(Exception $e){
    echo "Erro ao excluir: " . $e->getMessage();
}