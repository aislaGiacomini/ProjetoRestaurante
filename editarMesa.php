<?php
    require("cabecalho.php");
    require("conexao.php");

    $id = $_GET['id'];

    $stmt = $pdo->prepare("SELECT * FROM mesas WHERE id = ?");
    $stmt->execute([$id]);
    $mesa = $stmt->fetch(PDO::FETCH_ASSOC);

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $id = $_POST['id'];
        $numero = $_POST['numero'];
        $capacidade = $_POST['capacidade'];

        try{
            $stmt = $pdo->prepare("
                UPDATE mesas
                SET numero = ?, capacidade = ?
                WHERE id = ?
            ");
            if($stmt->execute([$numero, $capacidade, $id])){
                header("location: novaMesa.php?editar=true");
            }else{
                header("location: novaMesa.php?editar=false");
            }
        } catch(Exception $e){
            echo "Erro ao editar: ".$e->getMessage();
        }
    }

?>

<h1>Editar Mesa</h1>
<form method="post">
    <input type="hidden" name="id" value="<?= $mesa['id'] ?>">
    <div class="mb-3">
        <label for="numero" class="form-label">Informe o Numero</label>
        <input type="number" name="numero" value="<?= $mesa['numero']?>"></input>
    </div>

    <div class="mb-3">
        <label for="capacidade" class="form-label">Informe a capacidade</label>
        <input type="number" name="capacidade" value="<?= $mesa['capacidade'] ?>">
    </div>

    <button type="submit" class="btn btn-primary">Salvar alterações</button>
</form>

<?php
    require("rodape.php");
?>