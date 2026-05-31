<?php
    require("cabecalho.php");
    require("conexao.php");

    $id = $_GET['id'];

    $stmt = $pdo->prepare("SELECT * FROM clientes WHERE id = ?");
    $stmt->execute([$id]);
    $cliente = $stmt->fetch(PDO::FETCH_ASSOC);

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $id = $_POST['id'];
        $nome = $_POST['nome'];
        $telefone = $_POST['telefone'];

        try{
            $stmt = $pdo->prepare("
                UPDATE clientes
                SET nome = ?, telefone = ?
                WHERE id = ?
            ");
            if($stmt->execute([$nome, $telefone, $id])){
                header("location: novoCliente.php?editar=true");
            }else{
                header("location: novoCliente.php?editar=false");
            }
        } catch(Exception $e){
            echo "Erro ao editar: ".$e->getMessage();
        }
    }

?>

<h1>Editar Cliente</h1>
<form method="post">
    <input type="hidden" name="id" value="<?= $cliente['id'] ?>">
    <div class="mb-3">
        <label for="nome" class="form-label">Informe o nome</label>
        <input type="text" name="nome" value="<?= $cliente['nome']?>"></input>
    </div>

    <div class="mb-3">
        <label for="telefone" class="form-label">Informe o telefone</label>
        <input type="number" name="telefone" value="<?= $cliente['telefone'] ?>">
    </div>

    <button type="submit" class="btn btn-primary">Salvar alterações</button>
</form>

<?php
    require("rodape.php");
?>