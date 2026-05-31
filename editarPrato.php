<?php
    require("cabecalho.php");
    require("conexao.php");

    $id = $_GET['id'];

    $stmt = $pdo->prepare("SELECT * FROM pratos WHERE id = ?");
    $stmt->execute([$id]);
    $prato = $stmt->fetch(PDO::FETCH_ASSOC);

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $id = $_POST['id'];
        $nome = $_POST['nome'];
        $preco = $_POST['preco'];
        $descricao = $_POST['descricao'];

        try{
            $stmt = $pdo->prepare("
                UPDATE pratos
                SET nome = ?, preco = ?, descricao = ?
                WHERE id = ?
            ");
            if($stmt->execute([$nome, $preco, $descricao, $id])){
                header("location: novoPrato.php?editar=true");
            }else{
                header("location: novoPrato.php?editar=false");
            }
        } catch(Exception $e){
            echo "Erro ao editar: ".$e->getMessage();
        }
    }

?>

<h1>Editar Prato</h1>
<form method="post">
    <input type="hidden" name="id" value="<?= $prato['id'] ?>">
    <div class="mb-3">
        <label for="nome" class="form-label">Informe o nome</label>
        <input type="text" name="nome" value="<?= $prato['nome']?>"></input>
    </div>

    <div class="mb-3">
        <label for="descricao" class="form-label">Informe a descrição</label>
        <textarea name="descricao"><?= $prato['descricao'] ?></textarea>
    </div>

    <div class="mb-3">
        <label for="preco" class="form-label">Informe o preco</label>
        <input type="number" step="0.01" name="preco" value="<?= $prato['preco'] ?>">
    </div>

    <button type="submit" class="btn btn-primary">Salvar alterações</button>
</form>

<?php
    require("rodape.php");
?>