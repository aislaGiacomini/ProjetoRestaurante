<?php
require("conexao.php");

$id = $_GET['id'];

try {

    $stmt = $pdo->prepare("DELETE FROM mesas WHERE id = ?");

    if($stmt->execute([$id])){
        header("Location: novaMesa.php?excluir=true");
    } else {
        header("Location: novaMesa.php?excluir=false");
    }

} catch(Exception $e){
    echo "Erro ao excluir: " . $e->getMessage();
}