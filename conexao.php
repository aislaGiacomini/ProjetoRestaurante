<?php
    $dominio = "mysql:host=localhost;dbname=restaurante; charset=utf8"; 
    $usuario = "root";
    $senha = "";

    try {
        $pdo = new PDO($dominio, $usuario, $senha); #cria a conexao
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); #Lançar exceções quando ocorrerem erros.
    } catch (Exception $e) {
        die("Erro ao conectar ao banco!".$e->getMessage());
    }