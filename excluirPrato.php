<?php
require("conexao.php");

$id = $_GET['id'];

try {

    $stmt = $pdo->prepare("DELETE FROM pratos WHERE id = ?");

    if($stmt->execute([$id])){
        header("Location: novoPrato.php?excluir=true");
    } else {
        header("Location: novoPrato.php?excluir=false");
    }

} catch(Exception $e){
    echo "Erro ao excluir: " . $e->getMessage();
}